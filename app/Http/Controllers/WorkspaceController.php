<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use App\Services\WorkspaceService;
use App\Http\Requests\StoreWorkspaceRequest;
use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
    public function index()
{
    $workspaces = auth()
        ->user()
        ->workspaces()
        ->with('owner')
        ->get();

    return view(
        'workspaces.index',
        compact('workspaces')
    );
}
   public function create()
    {
        return view('workspaces.create');
    }


public function store(
    StoreWorkspaceRequest $request,
    WorkspaceService $service
)
{
    $service->create(
        auth()->user(),
        $request->validated()
    );

    return redirect()
        ->route('workspaces.index');
}


public function show(Workspace $workspace)
{
    $this->authorize(
        'view',
        $workspace
    );

    $workspace->load([
        'owner',
        'users'
    ]);

    return view(
        'workspaces.show',
        compact('workspace')
    );
}
}