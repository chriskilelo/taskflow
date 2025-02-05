<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'johndoe@example.com',
            ],
            [
                'first_name' => 'Test',
                'last_name' => 'User',
                'email' => 'test@example.com',
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Jackson',
                'email' => 'janejackson@example.com',
            ],
        ];
        foreach ($users as $user) {
            User::factory()->create($user);
        }
    }
}
