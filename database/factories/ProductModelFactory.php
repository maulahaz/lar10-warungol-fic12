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
            'price' => fake()->randomNumber(4),
            'stock' => fake()->randomNumber(2),
            'picture' => fake()->imageUrl(),
        ];
    }
}
