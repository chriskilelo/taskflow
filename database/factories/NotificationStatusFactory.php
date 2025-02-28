<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NotificationStatus>
 */
class NotificationStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => fake()->unique(true)->word(),
            'description' => fake()->sentence(5, true),
            'is_active' => fake()->boolean(60),
            'created_by' => 'SYSTEM FACTORY',
        ];
    }
}
