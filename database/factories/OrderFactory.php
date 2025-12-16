<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'order_number' => 'ORD' . date('Y-m-d'). '-' . str_pad(fake()->unique()->numberBetween(1, 99999), 3, '0', STR_PAD_LEFT),
            'total' => $this->faker->randomFloat(2,5,120),
            'payment_method' => $this->faker->randomElement(['CASH', 'CARD', 'PAYPEL']),
            'payment_status'=> $this->faker->randomElement(['pending', 'paid', 'failed']),

        ];
    }
}
