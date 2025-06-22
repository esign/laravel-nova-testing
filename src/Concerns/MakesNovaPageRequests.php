<?php

namespace Esign\NovaTesting\Concerns;

use Illuminate\Testing\TestResponse;
use Laravel\Nova\Nova;

trait MakesNovaPageRequests
{
    public function getNovaHomePage(): TestResponse
    {
        return $this->get(Nova::url('/'));
    }

    public function getNovaResourceIndexPage(string $resourceClass): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->get(Nova::url("/resources/{$resourceClass::uriKey()}"));
    }

    public function getNovaResourceDetailPage(string $resourceClass, mixed $resourceId): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->get(Nova::url("/resources/{$resourceClass::uriKey()}/{$resourceId}"));
    }

    public function getNovaDashboardPage(string $dashboard): TestResponse
    {
        return $this->get(Nova::url("/dashboards/{$dashboard}"));
    }

    public function getNovaResourceCreatePage(string $resourceClass): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->get(Nova::url("/resources/{$resourceClass::uriKey()}/new"));
    }

    public function getNovaResourceEditPage(string $resourceClass, mixed $resourceId): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->get(Nova::url("/resources/{$resourceClass::uriKey()}/{$resourceId}/edit"));
    }

    public function getNovaResourceReplicatePage(string $resourceClass, mixed $resourceId): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->get(Nova::url("/resources/{$resourceClass::uriKey()}/{$resourceId}/replicate"));
    }

    public function getNovaResourceLensPage(string $resourceClass, string $lens): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->get(Nova::url("/resources/{$resourceClass::uriKey()}/lens/{$lens}"));
    }
}
