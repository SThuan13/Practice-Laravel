<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        // Gate::define('create', function ($admin){

        // });
        Gate::define('isSuperAdmin', function ($user){
            return $user->role == 'super admin';
        });

        
        Gate::define('isAdmin', function ($user){
            return $user->role == 'admin';
        });
    }
}
