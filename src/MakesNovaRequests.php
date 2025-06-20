<?php

namespace Esign\NovaTesting;

use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;
use InvalidArgumentException;
use Laravel\Nova\Resource as NovaResource;

trait MakesNovaRequests
{
    protected function guardAgainstInvalidResourceClass(string $resourceClass): void
    {
        if (! is_subclass_of($resourceClass, NovaResource::class)) {
            throw new InvalidArgumentException(sprintf('The resource class must be a subclass of %s', NovaResource::class));
        }
    }

    protected function getNovaResourceIndex(string $resourceClass): TestResponse
    {
        $this->guardAgainstInvalidResourceClass($resourceClass);

        return $this->getJson('/nova-api/' . $resourceClass::uriKey());
    }

    protected function createNovaResource(string $resourceClass, array $data): TestResponse
    {
        $this->guardAgainstInvalidResourceClass($resourceClass);

        return $this->postJson('/nova-api/' . $resourceClass::uriKey(), $data);
    }

    protected function updateNovaResource(string $resourceClass, int $resourceId, array $data): TestResponse
    {
        $this->guardAgainstInvalidResourceClass($resourceClass);

        return $this->putJson('/nova-api/' . $resourceClass::uriKey() . '/' . $resourceId, $data);
    }

    protected function deleteNovaResource(string $resourceClass, array $resourceIds): TestResponse
    {
        $this->guardAgainstInvalidResourceClass($resourceClass);

        return $this->deleteJson('/nova-api/' . $resourceClass::uriKey() . '?' . Arr::query(['resources' => $resourceIds]));
    }
}
