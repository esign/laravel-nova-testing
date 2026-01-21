<?php

namespace Esign\NovaTesting\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;

trait MakesNovaFieldRequests
{
    public function getNovaResourceCreationFields(string $resourceClass, array $query = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->getJson("/nova-api/{$resourceClass::uriKey()}/creation-fields?" . Arr::query($query));
    }

    public function getNovaResourceUpdateFields(string $resourceClass, mixed $resourceId, array $query = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->getJson("/nova-api/{$resourceClass::uriKey()}/{$resourceId}/update-fields?" . Arr::query($query));
    }

    public function getNovaResourcePivotCreationFields(
        string $resourceClass,
        mixed $resourceId,
        string $relatedResourceClass,
        string $relationshipName,
        array $query = []
    ): TestResponse {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);
        $this->guardAgainstInvalidNovaResourceClass($relatedResourceClass);

        $uri = "/nova-api/{$resourceClass::uriKey()}/{$resourceId}/creation-pivot-fields/{$relatedResourceClass::uriKey()}";
        $queryString = Arr::query(['editing' => 'true', 'editMode' => 'attach', 'viaRelationship' => $relationshipName, ...$query]);

        return $this->getJson("{$uri}?{$queryString}");
    }

    public function getNovaResourcePivotUpdateFields(
        string $resourceClass,
        mixed $resourceId,
        string $relatedResourceClass,
        mixed $relatedResourceId,
        string $relationshipName,
        array $query = []
    ): TestResponse {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);
        $this->guardAgainstInvalidNovaResourceClass($relatedResourceClass);

        $uri = "/nova-api/{$resourceClass::uriKey()}/{$resourceId}/update-pivot-fields/{$relatedResourceClass::uriKey()}/{$relatedResourceId}";
        $queryString = Arr::query(['editing' => 'true', 'editMode' => 'update-attached', 'viaRelationship' => $relationshipName, ...$query]);

        return $this->getJson("{$uri}?{$queryString}");
    }

    public function patchNovaResourceUpdateFields(
        string $resourceClass,
        mixed $resourceId,
        string $field,
        string $component,
        array $data,
        array $query = []
    ): TestResponse {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        $uri = "/nova-api/{$resourceClass::uriKey()}/{$resourceId}/update-fields";
        $queryString = Arr::query([
            'editing' => 'true',
            'editMode' => 'update',
            'field' => $field,
            'component' => $component,
            ...$query,
        ]);

        return $this->patchJson("{$uri}?{$queryString}", $data);
    }

    public function deleteNovaResourceField(string $resourceClass, mixed $resourceId, string $field, array $query = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        $uri = "/nova-api/{$resourceClass::uriKey()}/{$resourceId}/field/{$field}";
        $queryString = Arr::query($query);

        return $this->deleteJson($queryString ? "{$uri}?{$queryString}" : $uri);
    }
}
