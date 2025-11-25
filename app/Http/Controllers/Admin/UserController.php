<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // This goes inside the UserController class
public function index()
{
    // Get all users, but not yourself (so you can't delete your own admin account)
    $users = User::where('id', '!=', auth()->id())->get();

    return view('admin.users.index', [
        'users' => $users
    ]);
}


public function edit(User $user)
{
    // Pass the $user we want to edit to the view
    return view('admin.users.edit', [
        'user' => $user
    ]);
}

public function update(Request $request, User $user)
{
    // 1. Validate the form data
    $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'role' => 'required|string|in:admin,contributor,viewer',
    ];

    // If a password was entered, add password rules
    if ($request->filled('password')) {
        $rules['password'] = ['required', 'confirmed', Rules\Password::defaults()];
    }

    $validated = $request->validate($rules);

    // 2. Update the user
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->role = $validated['role'];

    // If a password was entered, hash it and save it
    if ($request->filled('password')) {
        $user->password = Hash::make($validated['password']);
    }

    $user->save();

    // 3. Redirect back to the user list
    return redirect(route('admin.users.index'));
}

/**
 * Remove the specified user from storage.
 */
public function destroy(User $user)
{
    // Delete the user
    $user->delete();

    // Redirect back to the user list
    return redirect(route('admin.users.index'));
}


}
