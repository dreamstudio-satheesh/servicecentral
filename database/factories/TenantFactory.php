<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant>
 */
class TenantFactory extends Factory
{
    protected $model = Tenant::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'subdomain' => Str::slug($this->faker->company),
            'db_name' => 'tenant_' . Str::random(8),
            'plan_id' => Plan::factory(),
            'trial_start_date' => $this->faker->date,
            'trial_end_date' => $this->faker->date,
            'status' => $this->faker->randomElement(['trial', 'active', 'expired']),
            'next_billing_date' => $this->faker->date,
        ];
    }
}
