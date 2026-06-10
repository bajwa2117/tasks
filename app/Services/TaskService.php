<?php

namespace App\Services;

use App\Models\User;
use App\Models\Workspace;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskService
{
public function create(
Workspace $workspace,
User $user,
array $data
)
{
return $workspace
->tasks()
->create([

...$data,

'created_by' => $user->id,
]);
}
public function update(
    Task $task,
    array $data
)
{
    $task->update($data);

    return $task;
}

public function delete(
    Task $task
)
{
    $task->delete();
}
}