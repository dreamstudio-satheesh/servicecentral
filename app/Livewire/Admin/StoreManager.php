<?php

namespace App\Livewire\Admin;

use App\Models\Plan;
use App\Models\User;
use App\Models\Store;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\StoreManagementTrait;

class StoreManager extends Component
{
    use WithPagination, StoreManagementTrait;

    public $store_id, $name, $subdomain, $database_name, $plan_id, $user_id, $status= 'trial', $trial_start_date, $trial_end_date, $search;

    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'subdomain' => 'required|string|unique:stores,subdomain,' . $this->store_id,
            'database_name' => 'required|string|unique:stores,database_name,' . $this->store_id,
            'plan_id' => 'required|exists:plans,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:trial,active,suspended,cancelled',
            'trial_start_date' => 'nullable|date',
            'trial_end_date' => 'nullable|date|after_or_equal:trial_start_date',
        ];
    }

    public function render()
    {
        $query = Store::with('user');

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('subdomain', 'like', '%' . $this->search . '%');
            });
        }

        $stores = $query->orderBy('id', 'desc')->paginate(10);

        return view('livewire.admin.store-manager', [
            'stores' => $stores,
            'users' => User::where('role', 'tenant')->get(),
            'plans' => Plan::all(),
        ]);
    }

    public function resetInputFields()
    {
        $this->store_id = null;
        $this->name = '';
        $this->subdomain = '';
        $this->database_name = '';
        $this->plan_id = '';
        $this->user_id = '';
        $this->status = 'trial';
        $this->trial_start_date = '';
        $this->trial_end_date = '';
    }

    public function store()
    {
        // Validate dynamically
        $data=$this->validate();

         $data['store_id'] = $this->store_id;

        $this->createOrUpdateStore($data);

        $this->resetInputFields();
        session()->flash('success', $this->store_id ? 'Store Updated Successfully' : 'Store Created Successfully');
    }

    public function edit($id)
    {
        $store = Store::findOrFail($id);

        $this->store_id = $store->id;
        $this->name = $store->name;
        $this->subdomain = $store->subdomain;
        $this->database_name = $store->database_name;
        $this->plan_id = $store->plan_id;
        $this->user_id = $store->user_id;
        $this->status = $store->status;
        $this->trial_start_date = $store->trial_start_date;
        $this->trial_end_date = $store->trial_end_date;
    }

    public function delete($id)
    {
        Store::findOrFail($id)->delete();
        session()->flash('success', 'Store Deleted Successfully');
    }
}
