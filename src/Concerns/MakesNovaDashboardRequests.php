<?php

namespace Esign\NovaTesting\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;

trait MakesNovaDashboardRequests
{
    public function getNovaDashboard(string $dashboard, array $query = []): TestResponse
    {
        return $this->getJson("/nova-api/dashboards/{$dashboard}?" . Arr::query($query));
    }

    public function getNovaDashboardCards(string $dashboard, array $query = []): TestResponse
    {
        return $this->getJson("/nova-api/dashboards/cards/{$dashboard}?" . Arr::query($query));
    }

    public function getNovaDashboardMetric(string $dashboard, string $metric, array $query = []): TestResponse
    {
        return $this->getJson("/nova-api/dashboards/cards/{$dashboard}/metrics/{$metric}?" . Arr::query($query));
    }
}
