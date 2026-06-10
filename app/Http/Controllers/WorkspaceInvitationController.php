<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Workspace;
use App\Http\Requests\InviteWorkspaceMemberRequest;
use App\Notifications\WorkspaceInvitationNotification;
use Illuminate\Http\Request;

class WorkspaceInvitationController extends Controller
{
   public function store(
    InviteWorkspaceMemberRequest $request,
    Workspace $workspace
) {
    $this->authorize('manage', $workspace);

   
    $user = User::where('email', $request->email)->firstOrFail();

  
    $workspace->users()->syncWithoutDetaching([
        $user->id => [
            'role' => 'member',
        ],
    ]);

    // Send notification
    $user->notify(
        new WorkspaceInvitationNotification($workspace)
    );

    return back()->with(
        'success',
        'Member invited successfully.'
    );
}
}