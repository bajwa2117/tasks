<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'workspace_id',
        'created_by',
        'assigned_user_id',
        'title',
        'description',
        'status',
        'priority',
        'due_date'
    ];
  protected $casts = [
        'due_date' => 'date',
    ];
    public function workspace()
    {
        return $this->belongsTo(
            Workspace::class
        );
    }

    public function creator()
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }

    public function assignedUser()
    {
        return $this->belongsTo(
            User::class,
            'assigned_user_id'
        );
    }
}