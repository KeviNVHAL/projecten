<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Order;
use App\Models\Product;
use App\Http\Controllers\ShoppingCartController;
use Tests\TestCase;

class ShoppingCartControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if calculateTotalPrice returns total price of order.
     *
     * @return void
     */
    public function testCalculateTotalPrice()
    {
        // Create the products
        $product1 = Product::create([
            'name' => 'name',
            'price' => 20,
            'description' => 'description',
            'stock' => 0,
            'type' => 'type'
        ]);

        $product2 = Product::create([
            'name' => 'name',
            'price' => 40,
            'description' => 'description',
            'stock' => 0,
            'type' => 'type'
        ]);

        // Create the order
        $order = Order::create([
            'delivery_service' => "delivery_service",
            'delivery_date' => now()->format('Y-m-d'),
            'delivery_time' => now()->format('H:i:s'),
        ]);

        // Attach products to the order with quantities
        $order->products()->attach($product1->id, ['quantity' => 2]);
        $order->products()->attach($product2->id, ['quantity' => 3]);

        // Calculate the total price using the ShoppingCartController method
        $shopping_cart_controller = new ShoppingCartController();
        $totalPrice = $shopping_cart_controller->calculateTotalPrice($order);

        // Assert that the total price is calculated correctly
        $this->assertEquals(2 * 20 + 3 * 40, $totalPrice);
    }
}
