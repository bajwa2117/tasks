<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Workspace;
use App\Policies\WorkspacePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
  protected $policies = [
    Workspace::class =>
        WorkspacePolicy::class,
          Task::class => TaskPolicy::class,
];
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }

}