<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductModel>
 */
class ProductModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->text(),
            'category_id' => fake()->numberBetween(1, 4),
            'price' => fake()->numberBetween(10000, 100000),
            'stock' => fake()->numberBetween(1, 20),
            'picture' => fake()->imageUrl(),
        ];
    }
}
