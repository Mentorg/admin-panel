<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\File;
use App\Models\User;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use Spatie\Permission\Models\Role;
use App\Policies\PostPolicy;
use App\Policies\FilePolicy;
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
        Post::class => PostPolicy::class,
        File::class => FilePolicy::class,
        Role::class => RolePolicy::class,
        User::class => UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return $user->hasRole('Admin') ? true : null;
        });
    }
}
