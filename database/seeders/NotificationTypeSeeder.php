<?php

namespace Database\Seeders;

use App\Models\NotificationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notificationTypes = [
            [
                'type' => 'EMAIL',
                'description' => 'Email Notification',
                'is_active' => true,
                'created_by' => 'SYSTEM SEEDER',
            ],
            [
                'type' => 'SMS',
                'description' => 'SMS Notification',
                'is_active' => true,
                'created_by' => 'SYSTEM SEEDER',
            ],
            [
                'type' => 'PUSH',
                'description' => 'Push Notification',
                'is_active' => true,
                'created_by' => 'SYSTEM SEEDER',
            ],
            [
                'type' => 'IN-APP',
                'description' => 'In-App Notification',
                'is_active' => true,
                'created_by' => 'SYSTEM SEEDER',
            ],
        ];

        foreach ($notificationTypes as $type) {
            NotificationType::create($type);
        }
    }
}
