<?php

namespace Database\Factories;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    protected $model = Plan::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'billing_cycle' => $this->faker->randomElement(['monthly', 'yearly']),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'description' => $this->faker->sentence,
        ];
    }
}
