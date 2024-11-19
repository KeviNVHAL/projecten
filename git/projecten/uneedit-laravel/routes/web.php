<?php

require __DIR__ . '/auth.php';

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\WebshopController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\IsAdmin;
use App\Models\Product;

Route::get('/welcome', function () {
    return view('welcome');
})->name("welcome");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Middleware group for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public routes
Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/auth', function () {
    return view('auth');
})->name('auth');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/news', [NewsController::class, 'show'])->name('news');

Route::get('/request', function () {
    return view('request');
})->name('request.view');

Route::post('/request/create', [RequestController::class, 'create'])->name('request.create');

Route::get('/service', function () {
    return view('service');
})->name('service');

Route::prefix('webshop')->group(function () {
    Route::get('/', [WebshopController::class, 'index'])->name('webshop.index');

    Route::get('/product/{id}', function ($id) {
        $product = Product::find($id);
        return view('webshop.product', ['product' => $product]);
    });

    // Shopping Cart Page
    Route::get('/shopping_cart', function () {
        return view('webshop.shopping_cart');
    })->name('shopping_cart');

    Route::get('/THNX', function () {
        return view('webshop.THNX');
    })->name('THNX');

    Route::get('/delivery_services', function () {
        return view('webshop.delivery_services');
    })->name('delivery_services');

    Route::post('/delivery_services/update', [ShoppingCartController::class, 'saveDeliveryInfo'])->name('delivery.services.update');

    Route::get('/paypal', function () {
        return view('webshop.paypal');
    })->name('paypal');
});

Route::prefix('cart')->group(function () {
    Route::get('/', [ShoppingCartController::class, 'showCart'])->name('cart.show');
    Route::post('/add/{id}', [ShoppingCartController::class, 'addToCart'])->name('cart.add');
    Route::post('/toggle-update/{id}', [ShoppingCartController::class, 'toggleUpdateMode'])->name('cart.toggleUpdate');
    Route::post('/update/{id}', [ShoppingCartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/remove/{id}', [ShoppingCartController::class, 'removeFromCart'])->name('cart.remove');
    Route::delete('/forget', [ShoppingCartController::class, 'forget'])->name('cart.forget');
    Route::post('/checkout', [ShoppingCartController::class, 'checkout'])->name('cart.checkout');
});

// Admin routes with 'is_admin' middleware
Route::prefix('admin')->middleware(IsAdmin::class)->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index.view');

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'show_admin'])->name('admin.products.view');
        Route::post('/create', [ProductController::class, 'create']);
        Route::delete('/destroy/{id}', [ProductController::class, 'destroy']);
        Route::post('/update', [ProductController::class, 'update']);
    });

    // User Management Routes
    Route::get('/add_user', function () {
        return view('admin.add_user');
    })->name('admin.add.user.view');

    Route::post('/add_user', function () {
        return view('admin.add_user');
    });

    Route::get('/add_admin', function () {
        return view('admin.add_admin');
    })->name('admin.add.admin.view');

    Route::post('/add_admin', function () {
        return view('admin.add_admin');
    })->name('admin.add.admin');

    Route::post('/make/{id}', [UserController::class, 'make_admin'])->name('admin.make');
    Route::post('/remove/{id}', [UserController::class, 'remove_admin'])->name('admin.remove');

    Route::prefix('requests')->group(function () {
        // Request Management Routes
        Route::post('/create', [RequestController::class, 'create'])->name('admin.requests.create');
        Route::post('/update', [RequestController::class, 'update'])->name('admin.requests.update');
        Route::delete('/destroy/{id}', [RequestController::class, 'destroy'])->name('admin.requests.destroy');

        Route::get('/', [RequestController::class, 'show_admin'])->name('admin.requests.view');
    });

    Route::prefix('faq_panel')->group(function () {
        // FAQ Management Routes
        Route::post('/create', [FaqController::class, 'create'])->name('admin.faq.create');
        Route::post('/update', [FaqController::class, 'update'])->name('admin.faq.update');
        Route::delete('/destroy/{id}', [FaqController::class, 'destroy'])->name('admin.faq.destroy');

        Route::get('/', [FaqController::class, 'show_admin'])->name('admin.faq.panel.view');
    });

    Route::prefix('news')->group(function () {
        // News Management Routes
        Route::post('/create', [NewsController::class, 'create'])->name('admin.news.create');
        Route::post('/update', [NewsController::class, 'update'])->name('admin.news.update');
        Route::delete('/destroy/{id}', [NewsController::class, 'destroy'])->name('admin.news.destroy');

        // Admin Views for News
        Route::get('/', [NewsController::class, 'show_admin'])->name('admin.news.view');
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'show_admin'])->name('admin.orders.view');
        Route::post('/create', [OrderController::class, 'create'])->name('admin.orders.create');
        Route::post('/update', [OrderController::class, 'update'])->name('admin.orders.update');
        Route::delete('/destroy/{id}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
    });
});

// User Routes
Route::prefix('user')->group(function () {
    Route::group(['middleware' => RedirectIfAuthenticated::class], function () {
        Route::get('/login_or_signup', function () {
            return view('login_or_signup');
        })->name('login_or_signup');

        Route::post('/create', [UserController::class, 'create'])->name('user.create');
        Route::get('/create', function () {
            return view('user/create');
        })->name('user.create.view');

        Route::post('/login', [UserController::class, 'login'])->name('user.login');
        Route::get('/login', function () {
            return view('user/login');
        })->name('user.login.view');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::post('/save', [UserController::class, 'save'])->name('user.save');
        Route::get('/save', function () {
            return view('user/save');
        })->name('user.save.view');

        Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
    });
});
