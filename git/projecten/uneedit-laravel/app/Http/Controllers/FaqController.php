<?php

namespace App\Http\Controllers;

use App\Models\Faq; // Gebruik de juiste modelnaam 'Faq'
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public static function show()
    {
        return Faq::all();
    }

    public function show_admin()
    {
        // Retrieve all products and convert them to an array
        $table_data = Faq::all()->toArray();

        // Return the view with the products table_data
        return view('admin.faq_panel', compact('table_data'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'message' => 'string|max:255',
            'answer' => 'string|max:255',
        ]);

        Faq::create([
            'message' => $request->input('message') ?? "message",
            'answer' => $request->input('answer') ?? "answer",
        ]);

        return response()->json(['message' => 'Faq created successfully.'], 200);
    }

    public function update(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'message' => 'string|max:255',
            'answer' => 'string|max:255'
        ]);
        // Find the faq by its ID
        $faq = Faq::find($request->id);

        // If the faq exists, update its attributes
        if ($faq) {
            $faq->message = $validatedData['message'] ?? "message";
            $faq->answer = $validatedData['answer'] ?? "answer";

            // Save the changes
            $faq->save();

            return response()->json(['message' => 'Faq updated successfully.'], 200);
        }

        // If faq is not found, return a 404 response
        return response()->json(['message' => 'Faq not found.'], 404);
    }

    public function destroy($id)
    {
        Faq::destroy($id);
        return response()->json(['message' => 'Faq deleted successfully.'], 200);
    }
}
