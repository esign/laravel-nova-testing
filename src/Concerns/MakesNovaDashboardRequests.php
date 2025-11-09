<?php

namespace Esign\NovaTesting\Concerns;

use Illuminate\Testing\TestResponse;

trait MakesNovaDashboardRequests
{
    public function getNovaDashboard(string $dashboard): TestResponse
    {
        return $this->getJson("/nova-api/dashboards/{$dashboard}");
    }
}
