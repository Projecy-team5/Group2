<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Filter by name
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        // Filter by created date
        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->created_at);
        }

        $users = $query->paginate(10)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', 'string', 'min:8'],
                'is_admin' => ['required', 'boolean'],
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'is_admin' => $validated['is_admin'],
                'email_verified_at' => now(), // Auto-verify email for admin-created users
            ]);

            return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            \Log::error('User creation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create user: ' . $e->getMessage())->withInput();
        }
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
                'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
                'is_admin' => ['required', 'boolean'],
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
                'is_admin' => $request->is_admin,
            ]);

            return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update user. Please try again.')->withInput();
        }
    }

    public function destroy(User $user)
    {
        try {
            if (auth()->id() === $user->id) {
                return redirect()->route('admin.users.index')->with('error', 'You cannot delete your own account!');
            }

            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('error', 'Failed to delete user. Please try again.');
        }
    }
}
