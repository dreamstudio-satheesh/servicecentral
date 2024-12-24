<?php

namespace App\Livewire\Admin;

use App\Models\Store;
use App\Models\Plan;
use App\Models\User;
use Livewire\Component;

class TenantStoreSetup extends Component
{
    public $name;
    public $subdomain;
    public $database_name;
    public $plan_id=null;
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

        Store::create([
            'name' => $this->name,
            'subdomain' => $this->subdomain,
            'database_name' => $this->database_name,
            'plan_id' => $this->plan_id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'trial_start_date' => $this->trial_start_date,
            'trial_end_date' => $this->trial_end_date,
        ]);

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
