<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by'
    ];

    public function users()
{
    return $this->belongsToMany(
        User::class,
        'workspace_users'
    )
    ->withPivot('role')
    ->withTimestamps();
}

    public function owner()
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }
    public function isOwner(
    User $user
): bool
{
    return $this->users()
        ->where('user_id', $user->id)
        ->wherePivot('role', 'owner')
        ->exists();
}
public function tasks()
{
    return $this->hasMany(
        Task::class
    );
}
}