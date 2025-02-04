<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $priorities = [
            [
                'level' => 'Low',
                'description' => 'Low priority',
                'is_active' => true,
                'created_by' => 'admin',
            ],
            [
                'level' => 'Medium',
                'description' => 'Medium priority',
                'is_active' => true,
                'created_by' => 'admin',
            ],
            [
                'level' => 'High',
                'description' => 'High priority',
                'is_active' => true,
                'created_by' => 'admin',
            ],
        ];

        foreach ($priorities as $priority) {
            \App\Models\Priority::create($priority);
        }
    }

    
}
