<?php

namespace Esign\NovaTesting\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;

trait MakesNovaActionRequests
{
    public function getNovaResourceActions(string $resourceClass): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->getJson("/nova-api/{$resourceClass::uriKey()}/actions");
    }

    public function runNovaResourceAction(string $resourceClass, string $action, array $data = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        $uri = "/nova-api/{$resourceClass::uriKey()}/action";
        $queryString = Arr::query(['action' => $action]);

        return $this->postJson($uri . '?' . $queryString, $data);
    }
}
