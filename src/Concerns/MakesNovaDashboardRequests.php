<?php

namespace Esign\NovaTesting\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;

trait MakesNovaDashboardRequests
{
    public function getNovaDashboard(string $dashboard): TestResponse
    {
        return $this->getJson("/nova-api/dashboards/{$dashboard}");
    }

    public function getNovaDashboardCards(string $dashboard): TestResponse
    {
        return $this->getJson("/nova-api/dashboards/cards/{$dashboard}");
    }

    public function getNovaDashboardMetric(string $dashboard, string $metric, array $query = []): TestResponse
    {
        return $this->getJson("/nova-api/dashboards/cards/{$dashboard}/metrics/{$metric}?" . Arr::query($query));
    }
}
