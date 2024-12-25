<?php

use App\Livewire\Admin\PlanManager;
use App\Livewire\Admin\UserManager;
use App\Livewire\Admin\StoreManager;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\InvoiceManager;
use App\Livewire\Admin\TenantStoreSetup;
use App\Livewire\Admin\SubscriptionManager;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\SubscriptionController;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');


    // Subscription Management
    Route::get('subscriptions', SubscriptionManager::class)->name('subscription');

    // Invoice Management

    Route::get('/invoices', InvoiceManager::class);

    // User Management
    Route::get('/users', UserManager::class)->name('users');
    
    // Subscription Plans Management
    Route::get('/plans', PlanManager::class);

    // Store Management
    Route::get('/stores', StoreManager::class)->name('store.manager');
    Route::get('/stores/create', TenantStoreSetup::class)->name('store.setup');
});

