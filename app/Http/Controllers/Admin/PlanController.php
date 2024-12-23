<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:plans|max:255',
            'billing_cycle' => 'required|in:monthly,yearly',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable',
        ]);

        Plan::create($request->all());

        return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully.');
    }

    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'name' => 'required|unique:plans,name,' . $plan->id . '|max:255',
            'billing_cycle' => 'required|in:monthly,yearly',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable',
        ]);

        $plan->update($request->all());

        return redirect()->route('admin.plans.index')->with('success', 'Plan updated successfully.');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();

        return redirect()->route('admin.plans.index')->with('success', 'Plan deleted successfully.');
    }
}
