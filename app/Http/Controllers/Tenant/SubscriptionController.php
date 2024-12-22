<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = auth()->user()->tenant->subscriptions;
        return view('tenant.subscriptions.index', compact('subscriptions'));
    }

    public function requestTrial(Request $request)
    {
        // Logic to handle free trial request
        return redirect()->route('tenant.subscriptions.index')->with('success', 'Trial requested.');
    }

    public function upgrade(Request $request)
    {
        // Logic to handle subscription upgrade
        return redirect()->route('tenant.subscriptions.index')->with('success', 'Subscription upgraded.');
    }
}
