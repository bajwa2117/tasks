<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workspace;
use App\Models\Task;
use App\Services\TaskService;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    public function index(
    Request $request,
    Workspace $workspace
)
{
    $this->authorize(
        'view',
        $workspace
    );

    $tasks = $workspace
        ->tasks()
        ->with([
            'creator',
            'assignedUser'
        ])
        ->when(
            $request->status,
            fn($q,$status) =>
                $q->where(
                    'status',
                    $status
                )
        )
        ->when(
            $request->assigned_user,
            fn($q,$user) =>
                $q->where(
                    'assigned_user_id',
                    $user
                )
        )
        ->latest()
        ->get();

    return view(
        'tasks.index',
        compact(
            'workspace',
            'tasks'
        )
    );
}

public function create(
    Workspace $workspace
)
{
    $this->authorize(
        'view',
        $workspace
    );

    $members = $workspace
        ->users()
        ->get();

    return view(
        'tasks.create',
        compact(
            'workspace',
            'members'
        )
    );
}

public function store(
    StoreTaskRequest $request,
    Workspace $workspace,
    TaskService $service
)
{
    $this->authorize(
        'view',
        $workspace
    );

    $service->create(
        $workspace,
        auth()->user(),
        $request->validated()
    );

    return redirect()
        ->route(
            'workspaces.tasks.index',
            $workspace
        );
}

public function show(
    Workspace $workspace,
    Task $task
)
{
    $task = $workspace
        ->tasks()
        ->with([
            'creator',
            'assignedUser'
        ])
        ->findOrFail(
            $task->id
        );

    $this->authorize(
        'view',
        $task
    );

    return view(
        'tasks.show',
        compact(
            'workspace',
            'task'
        )
    );
}

public function edit(
    Workspace $workspace,
    Task $task
)
{
    $task = $workspace
        ->tasks()
        ->findOrFail(
            $task->id
        );

    $this->authorize(
        'update',
        $task
    );

    $members = $workspace
        ->users()
        ->get();

    return view(
        'tasks.edit',
        compact(
            'workspace',
            'task',
            'members'
        )
    );
}

public function update(
    UpdateTaskRequest $request,
    Workspace $workspace,
    Task $task,
    TaskService $service
)
{
    $task = $workspace
        ->tasks()
        ->findOrFail(
            $task->id
        );

    $this->authorize(
        'update',
        $task
    );

    $service->update(
        $task,
        $request->validated()
    );

    return redirect()
        ->route(
            'workspaces.tasks.index',
            $workspace
        );
}

public function destroy(
    Workspace $workspace,
    Task $task,
    TaskService $service
)
{
    $task = $workspace
        ->tasks()
        ->findOrFail(
            $task->id
        );

    $this->authorize(
        'delete',
        $task
    );

    $service->delete(
        $task
    );

    return back();
}
}