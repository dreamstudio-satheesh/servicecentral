<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function index()
    {
        $users = User::where('role', 'admin')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }
}
