<?php

namespace Esign\NovaTesting\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;

trait MakesNovaAssociatableRequests
{
    public function getNovaAssociatable(
        string $resourceClass,
        string $field,
        mixed $resourceId,
        string $component,
        string $search = '',
        array $query = []
    ): TestResponse {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        $queryParams = [
            'resourceId' => $resourceId,
            'component' => $component,
            'search' => $search,
            ...$query,
        ];

        $queryString = Arr::query($queryParams);

        return $this->getJson("/nova-api/{$resourceClass::uriKey()}/associatable/{$field}?{$queryString}");
    }
}
