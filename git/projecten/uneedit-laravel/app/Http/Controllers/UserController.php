<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function create(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        // Hash the password
        $validated['password'] = bcrypt($validated['password']);

        // Create the user
        User::create($validated);

        // Redirect or return a response
        return redirect()->route('index')->with('success', 'User created successfully.');
    }

    public function save(Request $request)
    {
        $user = Auth::user();

        // Validate the input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update user information
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('user.save.view')->with('success', 'Profile updated successfully.');
    }

    public static function show()
    {
        $user = Auth::user();
        echo "<p><strong>Naam:</strong> {$user->name}</p>";
        echo "<p><strong>Telefoonnummer:</strong> {$user->phone}</p>";
        echo "<p><strong>Adres:</strong> {$user->address}</p>";
        echo "<p><strong>Email:</strong> {$user->email}</p>";
    }

    public function login(Request $request)
    {
        // Validate the form data
        $credentials = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            // If login is successful, redirect to the intended route or dashboard
            return redirect()->intended('/')->with('success', 'You are logged in!');
        }

        // If authentication fails, redirect back with an error message
        return redirect()->back()->with('error', 'Invalid email or password.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index');
    }

    public function make_admin($id)
    {
        $user = User::findOrFail($id);
        $user->is_admin = true;
        $user->save();

        return redirect()->back()->with('success', 'User promoted to admin.');
    }

    /**
     * Demote an admin to a regular user.
     */
    public function remove_admin($id)
    {
        $user = User::findOrFail($id);
        $user->is_admin = false;
        $user->save();

        return redirect()->back()->with('success', 'Admin demoted to user.');
    }

    /**
     * Display the list of users categorized by their role.
     */
    public function index()
    {

        return view('admin.add.user.index', compact('admins', 'users'));
    }

    public static function get_admins()
    {
        return User::where('is_admin', true)->get();
    }

    public static function get_users()
    {
        return User::where('is_admin', false)->get();
    }
}
