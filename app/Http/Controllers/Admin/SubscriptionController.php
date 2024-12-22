<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    // Display a list of subscriptions
    public function index()
    {
        $tenants = Tenant::all();
        return view('admin.subscriptions.index', compact('tenants'));
    }

    // Assign a free trial to a tenant
    public function assignTrial(Request $request)
    {
        $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
        ]);

        $tenant = Tenant::findOrFail($request->tenant_id);
        $tenant->update([
            'trial_ends_at' => now()->addDays(15),
        ]);

        return redirect()->route('admin.subscriptions.index')->with('success', 'Free trial assigned successfully.');
    }

    // Upgrade tenant's subscription
    public function upgrade(Request $request)
    {
        $validated = $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'plan' => 'required|string',
        ]);

        $tenant = Tenant::findOrFail($validated['tenant_id']);
        $tenant->update([
            'plan' => $validated['plan'],
            'trial_ends_at' => null, // End the trial if upgrading
        ]);

        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription upgraded successfully.');
    }
}
