<?php

namespace Esign\NovaTesting\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;
use Laravel\Nova\Nova;

trait MakesNovaPageRequests
{
    public function getNovaHomePage(array $query = []): TestResponse
    {
        return $this->get(Nova::url('/' . '?' . Arr::query($query)));
    }

    public function getNovaResourceIndexPage(string $resourceClass, array $query = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->get(Nova::url("/resources/{$resourceClass::uriKey()}" . '?' . Arr::query($query)));
    }

    public function getNovaResourceDetailPage(string $resourceClass, mixed $resourceId, array $query = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->get(Nova::url("/resources/{$resourceClass::uriKey()}/{$resourceId}" . '?' . Arr::query($query)));
    }

    public function getNovaDashboardPage(string $dashboard, array $query = []): TestResponse
    {
        return $this->get(Nova::url("/dashboards/{$dashboard}" . '?' . Arr::query($query)));
    }

    public function getNovaResourceCreatePage(string $resourceClass, array $query = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->get(Nova::url("/resources/{$resourceClass::uriKey()}/new" . '?' . Arr::query($query)));
    }

    public function getNovaResourceEditPage(string $resourceClass, mixed $resourceId, array $query = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->get(Nova::url("/resources/{$resourceClass::uriKey()}/{$resourceId}/edit" . '?' . Arr::query($query)));
    }

    public function getNovaResourceReplicatePage(string $resourceClass, mixed $resourceId, array $query = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->get(Nova::url("/resources/{$resourceClass::uriKey()}/{$resourceId}/replicate" . '?' . Arr::query($query)));
    }

    public function getNovaResourceLensPage(string $resourceClass, string $lens, array $query = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->get(Nova::url("/resources/{$resourceClass::uriKey()}/lens/{$lens}" . '?' . Arr::query($query)));
    }
}
