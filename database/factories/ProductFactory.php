<?php

namespace Database\Factories;

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
            'name' => $this->faker->words(3, true), // e.g. "Wireless Headphones Pro"
            'description' => $this->faker->sentence(10), // short fake description
            'price' => $this->faker->randomFloat(2, 100, 9999), // min 100, max 9999, 2 decimal points
            'stock' => $this->faker->numberBetween(10, 500), // random stock count
        ];
    }
}
