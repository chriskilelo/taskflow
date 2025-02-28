<?php

namespace Database\Seeders;

use App\Models\NotificationStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notificationStatuses = [
            [
                'status' => 'PENDING',
                'description' => 'Notification is pending',
                'is_active' => true,
                'created_by' => 'SYSTEM SEEDER',
            ],
            [
                'status' => 'SENT',
                'description' => 'Notification has been sent',
                'is_active' => true,
                'created_by' => 'SYSTEM SEEDER',
            ],
            [
                'status' => 'FAILED',
                'description' => 'Notification failed to send',
                'is_active' => true,
                'created_by' => 'SYSTEM SEEDER',
            ],
        ];

        foreach ($notificationStatuses as $notificationStatus) {
            NotificationStatus::create($notificationStatus);
        }
    }
}
