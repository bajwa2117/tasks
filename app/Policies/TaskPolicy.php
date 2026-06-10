<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Models\Workspace;

class TaskPolicy
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
  public function view(
    User $user,
    Task $task
): bool {

    return $task->workspace
        ->users()
        ->where('user_id',$user->id)
        ->exists();
}

    /**
     * Determine whether the user can create models.
     */
    public function create(
    User $user,
    Workspace $workspace
): bool {

    return $workspace
        ->users()
        ->where('user_id',$user->id)
        ->exists();
}

    /**
     * Determine whether the user can update the model.
     */
   public function update(
    User $user,
    Task $task
): bool {

    return $task->created_by === $user->id

        ||

        $task->workspace
            ->users()
            ->where('user_id',$user->id)
            ->wherePivot(
                'role',
                'owner'
            )
            ->exists();
}

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(
    User $user,
    Task $task
): bool {

    return $this->update(
        $user,
        $task
    );
}

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Task $task): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Task $task): bool
    {
        //
    }
}