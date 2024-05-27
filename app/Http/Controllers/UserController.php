<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Assuming your User model is in the Models directory

class UserController extends Controller
{
    public function index()
    {
        // Retrieve all users from the database
        $users = User::all();
        
        // Pass users data to the view
        return view('users.index', compact('users'));
    }

    public function tambah()
    {
        // Return the view for adding a new user
        return view('users.tambah');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'level' => 'required',
        ]);

        // Create a new user record
        User::create($validatedData);

        // Redirect back with success message
        return redirect()->route('user.index')->with('success', 'User added successfully.');
    }

    public function edit($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);
        
        // Return the view for editing the user
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required',
            'level' => 'required',
        ]);

        // Find the user by ID and update its attributes
        $user = User::findOrFail($id);
        $user->update($validatedData);

        // Redirect back with success message
        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        // Find the user by ID and delete it
        $user = User::findOrFail($id);
        $user->delete();

        // Redirect back with success message
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
