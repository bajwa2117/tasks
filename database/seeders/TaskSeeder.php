<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        Task::create([
            'workspace_id' => 1,
            'created_by' => 1,
            'assigned_user_id' => 2,
            'title' => 'Design Homepage',
            'description' => 'Create homepage UI',
            'status' => 'todo',
            'priority' => 'high',
        ]);

        Task::create([
            'workspace_id' => 1,
            'created_by' => 1,
            'assigned_user_id' => 2,
            'title' => 'Create Login Page',
            'description' => 'Build login screen',
            'status' => 'in_progress',
            'priority' => 'medium',
        ]);

        Task::create([
            'workspace_id' => 1,
            'created_by' => 2,
            'assigned_user_id' => 2,
            'title' => 'Fix Navbar',
            'description' => 'Responsive navbar',
            'status' => 'done',
            'priority' => 'low',
        ]);

        Task::create([
            'workspace_id' => 2,
            'created_by' => 1,
            'assigned_user_id' => null,
            'title' => 'Marketing Campaign',
            'description' => 'Prepare campaign',
            'status' => 'todo',
            'priority' => 'high',
        ]);

        Task::create([
            'workspace_id' => 2,
            'created_by' => 1,
            'assigned_user_id' => null,
            'title' => 'Social Media Posts',
            'description' => 'Schedule posts',
            'status' => 'in_progress',
            'priority' => 'medium',
        ]);
    }
}