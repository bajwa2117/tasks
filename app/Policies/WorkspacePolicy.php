<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Auth\Access\Response;

class WorkspacePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
   public function view(User $user, Workspace $workspace): bool {

    return $workspace
        ->users()
        ->where('user_id',$user->id)
        ->exists();
}


public function manage(
    User $user,
    Workspace $workspace
): bool {

    return $workspace
        ->users()
        ->where('user_id',$user->id)
        ->wherePivot('role','owner')
        ->exists();
}
    /**
     * Determine whether the user can create models.
     */
public function create(
    User $user
): bool
{
    return true;
}

public function update(
    User $user,
    Workspace $workspace
): bool
{
    return $this->manage(
        $user,
        $workspace
    );
}

public function delete(
    User $user,
    Workspace $workspace
): bool
{
    return $this->manage(
        $user,
        $workspace
    );
}

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Workspace $workspace): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Workspace $workspace): bool
    {
        //
    }
}