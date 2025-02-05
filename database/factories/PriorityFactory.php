<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Priority>
 */
class PriorityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'level' => fake()->unique(true)->word(),
            'description' => fake()->sentence(6, true),
            'is_active' => fake()->boolean(60),
            'created_by' => 'SYSTEM FACTORY',

        ];
    }
}
