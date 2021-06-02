<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        Passport::personalAccessTokensExpireIn(now()->addDays(15));

        try {
            Permission::get(['name', 'message'])->map(function ($permission) {
                Gate::define($permission->name, function ($user) use ($permission) {
                    return $user->hasAllow($permission->name)
                        ? Response::allow()
                        : Response::deny($permission->message);
                });
            });
        }
        catch (\Exception $e) {
            return [];
        }
    }
}
