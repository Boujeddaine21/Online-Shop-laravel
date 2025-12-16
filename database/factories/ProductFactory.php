<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake() -> word(),
            'categorie_id' => Categorie::inRandomOrder()->first()->id,
            'description' => fake() -> sentence(),
            'price'=> $this->faker->randomFloat(2, 10, 100),
            'image'=> fake()->randomElement(['laptop.png', 'phone.png', 'tablet.png', 'book.png']),
            'quantity'=> $this->faker->numberBetween(0,500),
            'is_active'=> fake()->boolean(90),

        ];
    }
}
