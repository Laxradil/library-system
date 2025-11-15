<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // This Gate checks if a user is an Admin
        Gate::define('is-admin', function(User $user) {
            return $user->role === 'admin';
        });

        // This Gate checks if a user is a Contributor OR an Admin
        Gate::define('is-contributor', function(User $user) {
            return in_array($user->role, ['admin', 'contributor']);
        });

        // This Gate checks if a user is at least a Viewer (everyone)
        Gate::define('is-viewer', function(User $user) {
            return in_array($user->role, ['admin', 'contributor', 'viewer']);
        });
    }
}
