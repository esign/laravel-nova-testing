<?php

namespace Esign\NovaTesting\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;

trait MakesNovaActionRequests
{
    public function getNovaResourceActions(string $resourceClass, array $query = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->getJson("/nova-api/{$resourceClass::uriKey()}/actions?" . Arr::query($query));
    }

    public function runNovaResourceAction(string $resourceClass, string $action, array $data = [], array $query = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        $uri = "/nova-api/{$resourceClass::uriKey()}/action";
        $queryString = Arr::query(['action' => $action, ...$query]);

        return $this->postJson($uri . '?' . $queryString, $data);
    }
}
