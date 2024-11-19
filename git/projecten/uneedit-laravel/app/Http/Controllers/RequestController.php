<?php

namespace App\Http\Controllers;

use App\Models\Request;
use Illuminate\Http\Request as HttpRequest; // Alias to avoid conflict

class RequestController extends Controller
{
    public function show_admin()
    {
        // Retrieve all requests and convert them to an array
        $table_data = Request::all()->toArray();

        // Return the view with the requests table_data
        return view('admin.requests', compact('table_data'));
    }

    // Store a new request
    public function create(HttpRequest $http_request)
    {
        // Validate the incoming data
        $validated = $http_request->validate([
            'device_type' => 'string|max:255',
            'device_name' => 'string|max:255',
            'problem'     => 'string|max:255',
            'telephone'   => 'string|max:255',
            'email'       => 'email|max:255',
        ]);

        // Create a new product instance
        $request = new Request();
        $request->device_type = $validated['device_type'] ?? 'device_type';
        $request->device_name = $validated['device_name'] ?? 'device_name';
        $request->problem = $validated['problem'] ?? 'problem';
        $request->telephone = $validated['telephone'] ?? 'telephone';
        $request->email = $validated['email'] ?? 'email@email.com';

        // Save the new product to the database
        $request->save();

        return redirect()->route('request.view');
    }

    public function update(HttpRequest $http_request)
    {
        // Validate the incoming data
        $validated = $http_request->validate([
            'device_type' => 'string|max:255',
            'device_name' => 'string|max:255',
            'problem'     => 'string|max:255',
            'telephone'   => 'string|max:255',
            'email'       => 'email|max:255',
        ]);

        // Find the request by its ID
        $request = Request::find($http_request->id);

        // If the request exists, update its attributes
        if ($request) {
            $request->device_type = $validated['device_type'];
            $request->device_name = $validated['device_name'];
            $request->problem = $validated['problem'];
            $request->telephone = $validated['telephone'];
            $request->email = $validated['email'];

            // Save the changes
            $request->save();

            return response()->json(['message' => 'Request updated successfully.'], 200);
        }

        // If request is not found, return a 404 response
        return response()->json(['message' => 'Request not found.'], 404);
    }

    // Delete a request by ID
    public function destroy($id)
    {
        $request = Request::findOrFail($id);
        $request->delete();

        return response()->json(['message' => 'Request deleted successfully']);
    }
}
