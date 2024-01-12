<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Soal>
 */
class SoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pertanyaan' => fake()->sentence(),
            'kategori' => fake()->randomElement(['Area-1', 'Area-2','Area-3','Area-9']),
            'opsi_a' => fake()->sentence(),
            'opsi_b' => fake()->sentence(),
            'opsi_c' => fake()->sentence(),
            'opsi_d' => fake()->sentence(),
            'jawaban' => fake()->randomElement(['a', 'b','c','d']),
        ];
    }
}
