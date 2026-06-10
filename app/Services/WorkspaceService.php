<?php

namespace App\Services;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Support\Facades\DB;

class WorkspaceService
{
    public function create(User $user, array $data)
    {
        return DB::transaction(function () use ($user, $data) {

            $workspace = Workspace::create([
                'name'       => $data['name'],
                'created_by' => $user->id,
            ]);

            $workspace->users()->attach(
                $user->id,
                ['role' => 'owner']
            );

            return $workspace;
        });
    }
}