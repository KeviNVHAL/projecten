<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show_admin()
    {
        $table_data = Order::with('products')->get()->map(function ($order) {
            $order->product_list = $order->products->map(function ($product) {
                return "ID: {$product->id} | Name: {$product->name} | Quantity: {$product->pivot->quantity}";
            })->implode("\n");

            unset($order->products);

            return $order;
        })->toArray();

        return view('admin.orders', compact('table_data'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'delivery_service' => 'string|max:255',
            'delivery_date' => 'string|max:255',
            'delivery_time' => 'string|max:255',
            'created_at' => 'string|max:255',
            'updated_at' => 'string|max:255'
        ]);

        Order::create([
            'delivery_service' => $request->input('delivery_service') ?? "delivery_service",
            'delivery_date' => $request->input('delivery_date') ?? date("Y-m-d"),
            'delivery_time' => $request->input('delivery_time') ?? date('H:i:s'),
            'created_at' => $request->input('created_at') ?? "created_at",
            'updated_at' => $request->input('updated_at') ?? "updated_at"
        ]);

        return response()->json(['message' => 'Order created successfully.'], 200);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'delivery_service' => 'string|max:255',
            'delivery_date' => 'string|max:255',
            'delivery_time' => 'string|max:255',
            'created_at' => 'string|max:255',
            'updated_at' => 'string|max:255'
        ]);

        $order = Order::find($request->id);

        if ($order) {
            $order->delivery_service = $validatedData['delivery_service'] ?? "delivery_service";
            $order->delivery_date = $validatedData['delivery_date'] ?? "delivery_date";
            $order->delivery_time = $validatedData['delivery_time'] ?? "delivery_time";
            $order->created_at = $validatedData['created_at'] ?? "created_at";
            $order->updated_at = $validatedData['updated_at'] ?? "updated_at";
            $order->save();
            return response()->json(['message' => 'Order updated successfully.'], 200);
        }

        return response()->json(['message' => 'Order not found.'], 404);
    }

    public function destroy($id)
    {
        Order::destroy($id);
        return response()->json(['message' => 'Order deleted successfully.'], 200);
    }
}
