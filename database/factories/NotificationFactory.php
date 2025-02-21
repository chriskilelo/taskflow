<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Create an array of the basic fields
        $notificationArray = [
            'user_id' => 1,
            'subject' => fake()->sentence(),
            'message' => fake()->paragraph(),
            'type' => fake()->randomElement(['EMAIL', 'SMS', 'PUSH', 'IN-APP']),
            'created_by' => 'SYSTEM FACTORY',
            'send_attempts' => fake()->numberBetween(0, 5),
            'scheduled_at' => now(),
            'is_active' => fake()->boolean(60),
        ];

        // Introduce an error(s) to make sure we are not only dealing with the happy path
        $hasError = fake()->randomElement([true, false]);
        //  Check if we have an error
        if ($hasError === true) {
            $notificationArray['status'] = fake()->randomElement(['PENDING', 'SENT']);
            $notificationArray['is_sent'] = true;
            $notificationArray['sent_at'] = now();
            $notificationArray['has_error'] = false;
            $notificationArray['failed_at'] = null;
            $notificationArray['error_message'] = null;
        } else {
            $notificationArray['status'] = fake()->randomElement(['DEFERRED', 'FAILED']);
            $notificationArray['is_sent'] = false;
            $notificationArray['sent_at'] = null;
            $notificationArray['has_error'] = true;
            $notificationArray['failed_at'] = now();
            $notificationArray['error_message'] = fake()->sentence(10, true);
        }

        return $notificationArray;
    }
}
