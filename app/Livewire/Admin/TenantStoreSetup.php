<?php

namespace App\Livewire\Admin;

use App\Models\Plan;
use App\Models\User;
use App\Models\Store;
use Livewire\Component;
use App\Models\Subscription;

class TenantStoreSetup extends Component
{
    public $name;
    public $subdomain;
    public $database_name;
    public $plan_id = null;
    public $user_id;
    public $status = 'trial';
    public $trial_start_date;
    public $trial_end_date;

    protected $rules = [
        'name' => 'required|string|max:255',
        'subdomain' => 'required|string|unique:stores,subdomain|max:255',
        'database_name' => 'required|string|unique:stores,database_name|max:255',
        'plan_id' => 'nullable|exists:plans,id',
        'user_id' => 'required|exists:users,id',
        'status' => 'required|in:trial,active,suspended,cancelled',
        'trial_start_date' => 'nullable|date',
        'trial_end_date' => 'nullable|date|after_or_equal:trial_start_date',
    ];

    public function save()
    {
        $this->validate();

        // Handle Trial Status
        if ($this->status === 'trial') {
            $this->trial_start_date = now();
            $this->trial_end_date = now()->addDays(15);
        }

        // Create the store record
        $store = Store::create([
            'name' => $this->name,
            'subdomain' => $this->subdomain,
            'database_name' => $this->database_name,
            'plan_id' => $this->plan_id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'trial_start_date' => $this->trial_start_date,
            'trial_end_date' => $this->trial_end_date,
            'next_billing_date' => null, // Will update if a subscription is created
        ]);


        // Handle subscription logic if plan_id is selected
        if (!empty($this->plan_id)) {
            $plan = Plan::find($this->plan_id);

            

            // Determine subscription duration based on billing cycle
            $today = now(); 
            $planStartDate = $today->format('Y-m-d');  // Format the start date as YYYY-MM-DD
            $planEndDate = match ($plan->billing_cycle) {
                'monthly' => $today->copy()->addMonth()->format('Y-m-d'),
                'quarterly' => $today->copy()->addMonths(3)->format('Y-m-d'),
                'semi-annually' => $today->copy()->addMonths(6)->format('Y-m-d'),
                'yearly' => $today->copy()->addYear()->format('Y-m-d'),
                default => $today->copy()->addMonth()->format('Y-m-d'), // Default to monthly if unknown
            };

            // Create subscription record
            Subscription::create([
                'store_id' => $store->id,
                'plan_id' => $plan->id,
                'plan_start_date' => $planStartDate,
                'plan_end_date' => $planEndDate,
                'status' => 'active',
            ]);

            // Update the store's next billing date
            $store->update(['next_billing_date' => $planEndDate]);
        }

        $this->reset();
        session()->flash('success', 'Tenant store setup completed successfully!');
    }

    public function render()
    {
        return view('livewire.admin.tenant-store-setup', [
            'plans' => Plan::all(),
            'users' => User::where('role', 'tenant')->get(),
        ]);
    }
}
