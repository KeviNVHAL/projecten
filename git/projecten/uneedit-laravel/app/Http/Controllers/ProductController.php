<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id); // Find product by ID
        return view('webshop.product', compact('product')); // Pass the product to the view
    }

    public function show_admin()
    {
        // Retrieve all products and convert them to an array
        $table_data = Product::all()->toArray();

        // Return the view with the products table_data
        return view('admin.products', compact('table_data'));
    }

    public function create(Request $request)
    {
        // Validate the input data with default values
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'price' => 'numeric|min:0',
            'description' => 'nullable|string',
            'stock' => 'integer|min:0',
            'type' => 'string|max:255',
            'picture' => 'string|max:255',
        ]);

        // Create a new product instance
        $product = new Product();
        $product->name = $validatedData['name'] ?? 'name';
        $product->price = $validatedData['price'] ?? 9999;
        $product->description = $validatedData['description'] ?? 'description';
        $product->stock = $validatedData['stock'] ?? 0;
        $product->type = $validatedData['type'] ?? 'type';

        // Save the new product to the database
        $product->save();

        return response()->json(['message' => 'Product created successfully.', 'product' => $product], 201);
    }

    public function update(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'type' => 'string|max:255',
            'name' => 'string|max:255',
            'price' => 'numeric|min:0',
            'picture' => 'string|max:255',
            'stock' => 'integer|min:0',
            'description' => 'nullable|string|max:255'
        ]);
        // Find the product by its ID
        $product = Product::find($request->id);


        // If the product exists, update its attributes
        if ($product) {
            $product->type = $validatedData['type'];
            $product->name = $validatedData['name'];
            $product->price = $validatedData['price'];
            $product->picture = $validatedData['picture'];
            $product->stock = $validatedData['stock'];
            $product->description = $validatedData['description'];

            // Save the changes
            $product->save();

            return response()->json(['message' => 'Product updated successfully.'], 200);
        }

        // If product is not found, return a 404 response
        return response()->json(['message' => 'Product not found.'], 404);
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return response()->json(['message' => 'Faq deleted successfully.'], 200);
    }
}
