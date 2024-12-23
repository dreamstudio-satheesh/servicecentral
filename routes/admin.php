<?php

use App\Livewire\Admin\PlanManager;
use App\Livewire\Admin\UserManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\SubscriptionController;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // User Management
    Route::get('/users', [UserManager::class, 'index'])->name('users');

    // Tenant Management
    Route::get('/tenants', [TenantController::class, 'index'])->name('tenants.index');
    Route::get('/tenants/create', [TenantController::class, 'create'])->name('tenants.create');
    Route::post('/tenants', [TenantController::class, 'store'])->name('tenants.store');

    // Subscription Management
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::post('/subscriptions/assign-trial', [SubscriptionController::class, 'assignTrial'])->name('subscriptions.assignTrial');
    
    // Subscription Plans Management
    Route::get('/plans', PlanManager::class);
});

