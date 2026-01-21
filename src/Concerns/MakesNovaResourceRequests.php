<?php

namespace Esign\NovaTesting\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;

trait MakesNovaResourceRequests
{
    public function getNovaResourceIndex(string $resourceClass, array $query = [], array $filters = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        $queryParams = $query;

        if (! empty($filters)) {
            $queryParams['filters'] = base64_encode(json_encode($filters));
        }

        $queryString = Arr::query($queryParams);

        return $this->getJson("/nova-api/{$resourceClass::uriKey()}?{$queryString}");
    }

    public function getNovaResourceDetail(string $resourceClass, mixed $resourceId, array $query = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->getJson("/nova-api/{$resourceClass::uriKey()}/{$resourceId}?" . Arr::query($query));
    }

    public function createNovaResource(string $resourceClass, array $data, array $query = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->postJson("/nova-api/{$resourceClass::uriKey()}?" . Arr::query($query), $data);
    }

    public function updateNovaResource(string $resourceClass, mixed $resourceId, array $data, array $query = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->putJson("/nova-api/{$resourceClass::uriKey()}/{$resourceId}?" . Arr::query($query), $data);
    }

    public function deleteNovaResource(string $resourceClass, array $resourceIds, array $query = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->deleteJson("/nova-api/{$resourceClass::uriKey()}?" . Arr::query(['resources' => $resourceIds, ...$query]));
    }

    public function forceDeleteNovaResource(string $resourceClass, array $resourceIds, array $query = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->deleteJson("/nova-api/{$resourceClass::uriKey()}/force?" . Arr::query(['resources' => $resourceIds, ...$query]));
    }

    public function restoreNovaResource(string $resourceClass, array $resourceIds, array $query = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->putJson("/nova-api/{$resourceClass::uriKey()}/restore?" . Arr::query(['resources' => $resourceIds, ...$query]));
    }

    public function attachNovaResource(
        string $resourceClass,
        mixed $resourceId,
        string $relatedResourceClass,
        mixed $relatedResourceId,
        string $relationshipName,
        array $data = [],
        array $query = []
    ): TestResponse {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);
        $this->guardAgainstInvalidNovaResourceClass($relatedResourceClass);

        $uri = "/nova-api/{$resourceClass::uriKey()}/{$resourceId}/attach/{$relatedResourceClass::uriKey()}";
        $queryString = Arr::query(['editing' => 'true', 'editMode' => 'attach', ...$query]);

        return $this->postJson("{$uri}?{$queryString}", [
            'viaRelationship' => $relationshipName,
            $relationshipName => $relatedResourceId,
            ...$data,
        ]);
    }

    public function getNovaResourceCount(string $resourceClass, array $query = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->getJson("/nova-api/{$resourceClass::uriKey()}/count?" . Arr::query($query));
    }

    public function getNovaResourceFilters(string $resourceClass, array $query = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->getJson("/nova-api/{$resourceClass::uriKey()}/filters?" . Arr::query($query));
    }

    public function getNovaAssociatableResources(
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
