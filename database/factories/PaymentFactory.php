<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition()
    {
        return [
            'subscription_id' => Subscription::factory(),
            'amount' => $this->faker->randomFloat(2, 10, 100),
            'payment_date' => $this->faker->date,
            'payment_method' => $this->faker->randomElement(['Credit Card', 'PayPal', 'Bank Transfer']),
            'status' => $this->faker->randomElement(['success', 'failed', 'pending']),
        ];
    }
}
