<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    // Display a list of tenants
    public function index()
    {
        $tenants = Tenant::all();
        return view('admin.tenants.index', compact('tenants'));
    }

    // Show the form for creating a new tenant
    public function create()
    {
        return view('admin.tenants.create');
    }

    // Store a new tenant
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subdomain' => 'required|string|unique:tenants',
            'database_name' => 'required|string|unique:tenants',
            'plan' => 'required|string',
        ]);

        Tenant::create($validated);

        return redirect()->route('admin.tenants.index')->with('success', 'Tenant created successfully.');
    }

    // Show the details of a tenant
    public function show($id)
    {
        $tenant = Tenant::findOrFail($id);
        return view('admin.tenants.show', compact('tenant'));
    }

    // Show the form for editing a tenant
    public function edit($id)
    {
        $tenant = Tenant::findOrFail($id);
        return view('admin.tenants.edit', compact('tenant'));
    }

    // Update tenant details
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subdomain' => 'required|string|unique:tenants,subdomain,' . $id,
            'database_name' => 'required|string|unique:tenants,database_name,' . $id,
            'plan' => 'required|string',
        ]);

        $tenant = Tenant::findOrFail($id);
        $tenant->update($validated);

        return redirect()->route('admin.tenants.index')->with('success', 'Tenant updated successfully.');
    }

    // Delete a tenant
    public function destroy($id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->delete();

        return redirect()->route('admin.tenants.index')->with('success', 'Tenant deleted successfully.');
    }
}
