<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NotificationType>
 */
class NotificationTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->unique(true)->word(),
            'description' => fake()->sentence(5, true),
            'is_active' => fake()->boolean(60),
            'created_by' => 'SYSTEM FACTORY',
        ];
    }
}
