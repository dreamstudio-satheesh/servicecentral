<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\PlanManager;

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/admin/plans', PlanManager::class)->name('plans')->middleware(['auth', 'isAdmin']);

// Include Admin Routes
require base_path('routes/admin.php');

// Include Tenant Routes
require base_path('routes/tenant.php');