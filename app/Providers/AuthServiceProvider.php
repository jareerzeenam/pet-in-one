<?php

namespace App\Providers;

use Laravel\Passport\Passport;

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

        // * Laravel ACL
        // ! Admin
        Gate::define('isAdmin', function ($user) {
            return $user->type === 'admin';
        });
        // ! Admin and author
        Gate::define('isAdminOrAuthor', function ($user) {
            return $user->type === 'admin' && 'author';
        });

        // ! Author
        Gate::define('isAuthor', function ($user) {
            return $user->type === 'author';
        });

        // ! User
        Gate::define('isUser', function ($user) {
            return $user->type === 'user';
        });


        Passport::routes();

        //
    }
}
