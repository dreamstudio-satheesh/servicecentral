<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Plan;

class PlanManager extends Component
{
    use WithPagination;

    public $plan_id;
    public $name;
    public $billing_cycle;
    public $price;
    public $description;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
        'billing_cycle' => 'required|in:monthly,yearly',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
    ];

    public function render()
    {
        $plans = Plan::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.admin.plan-manager', compact('plans'));
    }

    public function resetInputFields()
    {
        $this->plan_id = null;
        $this->name = '';
        $this->billing_cycle = '';
        $this->price = null;
        $this->description = '';
    }

    public function store()
    {
        $this->validate();

        Plan::updateOrCreate(['id' => $this->plan_id], [
            'name' => $this->name,
            'billing_cycle' => $this->billing_cycle,
            'price' => $this->price,
            'description' => $this->description,
        ]);

        $this->resetInputFields();
        $this->dispatch('show-toastr', ['message' => 'Plan ' . ($this->plan_id ? 'Updated' : 'Created') . ' Successfully.']);
    }

    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        $this->plan_id = $plan->id;
        $this->name = $plan->name;
        $this->billing_cycle = $plan->billing_cycle;
        $this->price = $plan->price;
        $this->description = $plan->description;
    }

    public function delete($id)
    {
        Plan::findOrFail($id)->delete();
        session()->flash('success', 'Plan Deleted Successfully.');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
