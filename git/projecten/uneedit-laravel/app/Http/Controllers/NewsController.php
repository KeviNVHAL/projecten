<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function show_admin()
    {
        // Retrieve all requests and convert them to an array
        $table_data = News::all()->toArray();

        // Return the view with the requests table_data
        return view('admin.news', compact('table_data'));
    }

    public static function show()
    {
        $news_items = News::all();
        return view('news', compact('news_items'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'message' => 'string|max:255'
        ]);

        News::create([
            'message' => $request->input('message') ?? "message"
        ]);

        return response()->json(['message' => 'News created successfully.'], 200);
    }

    public function update(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'message' => 'string|max:255'
        ]);
        // Find the news by its ID
        $news = News::find($request->id);

        // If the news exists, update its attributes
        if ($news) {
            $news->message = $validatedData['message'] ?? "message";

            // Save the changes
            $news->save();

            return response()->json(['message' => 'News updated successfully.'], 200);
        }

        // If news is not found, return a 404 response
        return response()->json(['message' => 'News not found.'], 404);
    }

    public function destroy($id)
    {
        News::destroy($id);
        return response()->json(['message' => 'News deleted successfully.'], 200);
    }
}
