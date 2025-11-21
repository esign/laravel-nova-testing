<?php

namespace Esign\NovaTesting\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;

trait MakesNovaResourceRequests
{
    public function getNovaResourceIndex(string $resourceClass, array $filters = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        $query = [];

        if (! empty($filters)) {
            $query['filters'] = base64_encode(json_encode($filters));
        }

        $queryString = Arr::query($query);

        return $this->getJson("/nova-api/{$resourceClass::uriKey()}?{$queryString}");
    }

    public function getNovaResourceDetail(string $resourceClass, mixed $resourceId): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->getJson("/nova-api/{$resourceClass::uriKey()}/{$resourceId}");
    }

    public function createNovaResource(string $resourceClass, array $data): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->postJson("/nova-api/{$resourceClass::uriKey()}", $data);
    }

    public function updateNovaResource(string $resourceClass, mixed $resourceId, array $data): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->putJson("/nova-api/{$resourceClass::uriKey()}/{$resourceId}", $data);
    }

    public function deleteNovaResource(string $resourceClass, array $resourceIds): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->deleteJson("/nova-api/{$resourceClass::uriKey()}?" . Arr::query(['resources' => $resourceIds]));
    }

    public function forceDeleteNovaResource(string $resourceClass, array $resourceIds): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->deleteJson("/nova-api/{$resourceClass::uriKey()}/force?" . Arr::query(['resources' => $resourceIds]));
    }

    public function restoreNovaResource(string $resourceClass, array $resourceIds): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->putJson("/nova-api/{$resourceClass::uriKey()}/restore?" . Arr::query(['resources' => $resourceIds]));
    }

    public function attachNovaResource(
        string $resourceClass,
        mixed $resourceId,
        string $relatedResourceClass,
        mixed $relatedResourceId,
        string $relationshipName,
        array $data = []
    ): TestResponse {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);
        $this->guardAgainstInvalidNovaResourceClass($relatedResourceClass);

        $uri = "/nova-api/{$resourceClass::uriKey()}/{$resourceId}/attach/{$relatedResourceClass::uriKey()}";
        $queryString = Arr::query(['editing' => 'true', 'editMode' => 'attach']);

        return $this->postJson("{$uri}?{$queryString}", [
            'viaRelationship' => $relationshipName,
            $relationshipName => $relatedResourceId,
            ...$data,
        ]);
    }

    public function getNovaResourceCount(string $resourceClass): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->getJson("/nova-api/{$resourceClass::uriKey()}/count");
    }

    public function getNovaResourceFilters(string $resourceClass): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->getJson("/nova-api/{$resourceClass::uriKey()}/filters");
    }
}
