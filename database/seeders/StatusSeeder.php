<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusesData = [
            "Blocked|The task is unable to proceed due to a dependency or issue that needs to be resolved|1",
            "On Hold|The task is temporarily paused and cannot proceed at the moment|1",
            "Not Started|The task has been created but no action has been taken yet|1",
            "Overdue|The task was not completed within the set deadline|1",
            "In Progress|The task is in the process of execution|1",
            "Under Review|The task has been completed and is currently under review or quality assurance|1",
            "Completed|The task has successfully been completed and has passed quality assurance|1",
        ];
        foreach ($statusesData as $statusData) {
            // The data is separated using the pipe delimiter, we need to split it
            $statusDataComponents = explode('|', $statusData);
            // Create the status records
            Status::factory()->create([
                'status' => $statusDataComponents[0],
                'description' => $statusDataComponents[1],
                'is_active' => $statusDataComponents[2],
                'created_by' => 'SYSTEM SEEDER',
            ]);
        }        
    }
}
