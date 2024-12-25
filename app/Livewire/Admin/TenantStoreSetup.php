<?php

namespace App\Livewire\Admin;

use App\Models\Plan;
use App\Models\User;
use Livewire\Component;
use App\Traits\StoreManagementTrait;

class TenantStoreSetup extends Component
{
    use StoreManagementTrait;
    
    public $name, $subdomain, $database_name, $plan_id, $user_id, $status, $trial_start_date, $trial_end_date;

    public function save()
    {
        $data = $this->validate([
            'name' => 'required|string|max:255',
            'subdomain' => 'required|string|unique:stores,subdomain|max:255',
            'database_name' => 'required|string|unique:stores,database_name|max:255',
            'plan_id' => 'nullable|exists:plans,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:trial,active,suspended,cancelled',
            'trial_start_date' => 'nullable|date',
            'trial_end_date' => 'nullable|date|after_or_equal:trial_start_date',
        ]);

        $this->createOrUpdateStore($data);

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
