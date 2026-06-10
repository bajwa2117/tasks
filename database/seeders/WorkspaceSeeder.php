<?php

namespace Database\Seeders;

use App\Models\Workspace;
use Illuminate\Database\Seeder;

class WorkspaceSeeder extends Seeder
{
    public function run(): void
    {
        $workspace1 = Workspace::create([
            'name' => 'Development Team',
            'created_by' => 1,
        ]);

        $workspace2 = Workspace::create([
            'name' => 'Marketing Team',
            'created_by' => 1,
        ]);

        $workspace1->users()->attach(1, [
            'role' => 'owner'
        ]);

        $workspace1->users()->attach(2, [
            'role' => 'member'
        ]);

        $workspace2->users()->attach(1, [
            'role' => 'owner'
        ]);
    }
}