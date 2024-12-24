<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Subscription;
use App\Models\Plan;
use App\Models\Store;

class SubscriptionManager extends Component
{
    use WithPagination;

    public $subscription_id;
    public $store_id;
    public $plan_id;
    public $plan_start_date;
    public $plan_end_date;
    public $status = 'active';
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'store_id' => 'required|exists:stores,id',
        'plan_id' => 'required|exists:plans,id',
        'plan_start_date' => 'required|date',
        'plan_end_date' => 'required|date|after:plan_start_date',
        'status' => 'required|in:active,expired,pending_renewal,cancelled',
    ];

    public function render()
    {
        $query = Subscription::query();

        if (!empty($this->search)) {
            $query->whereHas('store', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('subdomain', 'like', '%' . $this->search . '%');
            });
        }

        $subscriptions = $query->orderBy('id', 'desc')->paginate(10);

        return view('livewire.admin.subscription-manager', [
            'subscriptions' => $subscriptions,
            'plans' => Plan::all(),
            'stores' => Store::all(),
        ]);
    }

    public function resetInputFields()
    {
        $this->subscription_id = null;
        $this->store_id = null;
        $this->plan_id = null;
        $this->plan_start_date = null;
        $this->plan_end_date = null;
        $this->status = 'active';
    }

    public function save()
    {
        $this->validate();

        Subscription::updateOrCreate(
            ['id' => $this->subscription_id],
            [
                'store_id' => $this->store_id,
                'plan_id' => $this->plan_id,
                'plan_start_date' => $this->plan_start_date,
                'plan_end_date' => $this->plan_end_date,
                'status' => $this->status,
            ]
        );

        session()->flash('success', $this->subscription_id ? 'Subscription Updated Successfully' : 'Subscription Created Successfully');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $subscription = Subscription::findOrFail($id);

        $this->subscription_id = $subscription->id;
        $this->store_id = $subscription->store_id;
        $this->plan_id = $subscription->plan_id;
        $this->plan_start_date = $subscription->plan_start_date->format('Y-m-d');
        $this->plan_end_date = $subscription->plan_end_date->format('Y-m-d');
        $this->status = $subscription->status;
    }

    public function delete($id)
    {
        Subscription::findOrFail($id)->delete();
        session()->flash('success', 'Subscription Deleted Successfully');
    }
}
