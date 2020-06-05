<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Define the Gates Here
        Gate::define('manage-users', function ($user) {
            return $user->hasAnyRole(['super_admin', 'admin']);
        });
        Gate::define('edit-users', function ($user) {
            return $user->hasAnyRole(['super_admin', 'admin']);
        });
        Gate::define('delete-users', function ($user) {
            return $user->hasAnyRole(['super_admin','admin']);
        });

        //Define the Customer Gates Here
        Gate::define('manage-customers', function ($user) {
            return $user->hasAnyRole(['super_admin', 'admin']);
        });
        Gate::define('view-customers', function ($user) {
            return $user->hasAnyRole(['super_admin', 'admin', 'user']);
        });
        Gate::define('edit-customers', function ($user) {
            return $user->hasAnyRole(['super_admin', 'admin']);
        });
        Gate::define('delete-customers', function ($user) {
            return $user->hasAnyRole(['super_admin', 'admin']);
        });

    }
}
