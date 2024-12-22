<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        // Check if the user is an admin
        if ($user && $user->role === 'admin') {
            return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
        }

        // If not an admin, redirect to the tenant dashboard
        return redirect()->route('tenant.dashboard'); // Redirect to tenant dashboard
    }
}
