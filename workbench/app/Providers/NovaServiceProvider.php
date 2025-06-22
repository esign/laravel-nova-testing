<?php

namespace Workbench\App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Workbench\App\Nova\Dashboards\MyDashboard;
use Workbench\App\Nova\Resources\Role;
use Workbench\App\Nova\Resources\User;

use function Orchestra\Testbench\workbench_path;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    protected function resources()
    {
        Nova::resources([
            User::class,
            Role::class,
        ]);
    }

    protected function dashboards()
    {
        return [
            MyDashboard::make(),
        ];
    }

    protected function gate(): void
    {
        Gate::define('viewNova', function ($user) {
            return true;
        });
    }
}
