<?php

namespace App\Providers;

use App\Models\Building;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        View::composer('backend.partial.roles', 'App\Http\ViewComposers\RoleComposer');
        View::composer('backend.partial.pages', 'App\Http\ViewComposers\PageComposer');

        Blade::if('admin', function (){
            return auth()->check() && auth()->user()->isAdmin();
        });

    }
}
