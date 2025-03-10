<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /**
         *  Uncomment the following lines to seed the database with sample data.
         * Adjust the number passed to the factory to determine the number of records created.
         **/ 
        $users = User::factory(10)->create();
        // Status::factory(40)->create();
        // Priority::factory(40)->create();
        Project::factory(15)->create();
        // Notification::factory(50)->create();

        $this->call([
            UserSeeder::class,
            PrioritySeeder::class,
            StatusSeeder::class,
            NotificationTypeSeeder::class,
            NotificationStatusSeeder::class,
        ]);
    }
}