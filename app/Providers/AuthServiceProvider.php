<?php

namespace App\Providers;

// We need these models and facades
use App\Models\User;
use App\Models\Book;
use App\Policies\BookPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Book::class => BookPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // This is where all your Gate logic goes!
        
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