<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\idea;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        Gate::define('admin' , function(User $user) {
            return $user->isAdmin;
        });

        Gate::define('ideas.edit' , function(User $user , idea $idea) {
            return ((bool) $user->isAdmin || $user->id === $idea->user_id );
        });

        Gate::define('ideas.delete' , function(User $user , idea $idea) {
            return ((bool) $user->isAdmin || $user->id === $idea->user_id );
        });
    }
}
