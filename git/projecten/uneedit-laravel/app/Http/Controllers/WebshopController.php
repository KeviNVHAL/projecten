<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Webshop;
use Illuminate\Http\Request;

class WebshopController extends Controller
{
    public function index(Request $request)
    {
        // Haal de producten op, met paginering
        $products = Webshop::paginate(10);

        // Controleer of er meer pagina's zijn
        $hasMore = $products->hasMorePages();

        if ($request->ajax()) {
            return response()->json([
                'products' => view('webshop._products', ['products' => $products])->render(),
                'hasMore' => $hasMore
            ]);
        }

        // Gegevens doorgeven aan de view
        return view('webshop.webshop', ['products' => $products, 'hasMore' => $hasMore]);
    }
}


