<?php

namespace App\Traits;

use App\Models\Plan;
use App\Models\Store;
use App\Models\Subscription;
use Carbon\Carbon;

trait StoreManagementTrait
{
    public function createOrUpdateStore($data)
    {
        $isCreating = empty($data['store_id']); 

        // Add trial dates only during creation
        if ($isCreating && $data['status'] === 'trial') {
            $data['trial_start_date'] = now()->format('Y-m-d');
            $data['trial_end_date'] = now()->addDays(15)->format('Y-m-d');
        }

        // Create or update the store
        $store = Store::updateOrCreate(
            ['id' => $data['store_id'] ?? null],
            [
                'name' => $data['name'],
                'subdomain' => $data['subdomain'],
                'database_name' => $data['database_name'],
                'plan_id' => $data['plan_id'],
                'user_id' => $data['user_id'],
                'status' => $data['status'],
                'trial_start_date' => $data['trial_start_date'] ?? null,
                'trial_end_date' => $data['trial_end_date'] ?? null,
                'next_billing_date' => null, // Updated later if a subscription exists
            ]
        );

        // Handle subscription if a plan is provided
        if (!empty($data['plan_id'])) {
            $this->createSubscriptionForStore($store, $data['plan_id']);
        }

        return $store;
    }

    private function createSubscriptionForStore($store, $planId)
    {
        $plan = Plan::find($planId);
        $today = Carbon::now();

        $subscription = Subscription::create([
            'store_id' => $store->id,
            'plan_id' => $plan->id,
            'plan_start_date' => $today->format('Y-m-d'),
            'plan_end_date' => match ($plan->billing_cycle) {
                'monthly' => $today->addMonth()->format('Y-m-d'),
                'quarterly' => $today->addMonths(3)->format('Y-m-d'),
                'semi-annually' => $today->addMonths(6)->format('Y-m-d'),
                'yearly' => $today->addYear()->format('Y-m-d'),
                default => $today->addMonth()->format('Y-m-d'),
            },
            'status' => 'active',
        ]);

        $store->update(['next_billing_date' => $subscription->plan_end_date]);
    }
}