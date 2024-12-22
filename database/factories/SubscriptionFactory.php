<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\Tenant;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    public function definition()
    {
        return [
            'tenant_id' => Tenant::factory(),
            'plan_id' => Plan::factory(),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'status' => $this->faker->randomElement(['active', 'inactive', 'cancelled']),
        ];
    }
}
