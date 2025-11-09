<?php

namespace Workbench\App\Nova\Dashboards;

use Laravel\Nova\Dashboard;
use Workbench\App\Nova\Metrics\NewUsers;

class MyDashboard extends Dashboard
{
    public function cards(): array
    {
        return [
            NewUsers::make(),
        ];
    }

    public function uriKey(): string
    {
        return 'my-dashboard';
    }
}
