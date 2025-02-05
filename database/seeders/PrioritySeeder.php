<?php

namespace Database\Seeders;

use App\Models\Priority;
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
                'created_by' => 'SYSTEM SEEDER',
            ],
            [
                'level' => 'Medium',
                'description' => 'Medium priority',
                'is_active' => true,
                'created_by' => 'SYSTEM SEEDER',
            ],
            [
                'level' => 'High',
                'description' => 'High priority',
                'is_active' => true,
                'created_by' => 'SYSTEM SEEDER',
            ],
        ];

        foreach ($priorities as $priority) {
            Priority::create($priority);
        }
    }

    
}
