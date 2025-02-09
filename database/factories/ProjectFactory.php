<?php

namespace Database\Factories;

use Doctrine\Inflector\Rules\Word;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Validation\Rules\Unique;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
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
            'description' => fake()->sentence(15, true),
            'status' => fake()->randomElement(['Blocked', 'On Hold', 'Not Started', 'Overdue', 'In Progress', 'Under Review', 'Completed']),
            'is_active' => fake()->boolean(60),
            'created_by' => 'SYSTEM FACTORY',
        ];
    }
}
