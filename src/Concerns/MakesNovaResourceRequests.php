<?php

namespace Esign\NovaTesting\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;

trait MakesNovaResourceRequests
{
    protected function getNovaResourceIndex(string $resourceClass): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->getJson('/nova-api/' . $resourceClass::uriKey());
    }

    protected function getNovaResourceDetail(string $resourceClass, mixed $resourceId): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->getJson('/nova-api/' . $resourceClass::uriKey() . '/' . $resourceId);
    }

    protected function createNovaResource(string $resourceClass, array $data): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->postJson('/nova-api/' . $resourceClass::uriKey(), $data);
    }

    protected function updateNovaResource(string $resourceClass, mixed $resourceId, array $data): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->putJson('/nova-api/' . $resourceClass::uriKey() . '/' . $resourceId, $data);
    }

    protected function deleteNovaResource(string $resourceClass, array $resourceIds): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->deleteJson('/nova-api/' . $resourceClass::uriKey() . '?' . Arr::query(['resources' => $resourceIds]));
    }

    protected function forceDeleteNovaResource(string $resourceClass, array $resourceIds): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->deleteJson('/nova-api/' . $resourceClass::uriKey() . '/force?' . Arr::query(['resources' => $resourceIds]));
    }

    protected function restoreNovaResource(string $resourceClass, mixed $resourceId): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->putJson('/nova-api/' . $resourceClass::uriKey() . '/' . $resourceId . '/restore');
    }

    protected function attachNovaResource(
        string $resourceClass,
        mixed $resourceId,
        string $relatedResourceClass,
        mixed $relatedResourceId,
        string $relationshipName,
        array $data = []
    ): TestResponse {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);
        $this->guardAgainstInvalidNovaResourceClass($relatedResourceClass);

        $uri = '/nova-api/' . $resourceClass::uriKey() . '/' . $resourceId . '/attach/' . $relatedResourceClass::uriKey();
        $queryString = Arr::query(['editing' => 'true', 'editMode' => 'attach']);

        return $this->postJson($uri . '?' . $queryString, [
            'viaRelationship' => $relationshipName,
            $relationshipName => $relatedResourceId,
            ...$data,
        ]);
    }

    protected function getNovaResourceCount(string $resourceClass): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->getJson('/nova-api/' . $resourceClass::uriKey() . '/count');
    }

    protected function getNovaResourceFilters(string $resourceClass): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->getJson('/nova-api/' . $resourceClass::uriKey() . '/filters');
    }
}
