<?php

namespace Esign\NovaTesting\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;

trait MakesNovaFieldRequests
{
    protected function getNovaResourceCreationFields(string $resourceClass): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->getJson('/nova-api/' . $resourceClass::uriKey() . '/creation-fields');
    }

    protected function getNovaResourceUpdateFields(string $resourceClass, mixed $resourceId): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->getJson('/nova-api/' . $resourceClass::uriKey() . '/' . $resourceId . '/update-fields');
    }

    protected function getNovaResourcePivotCreationFields(
        string $resourceClass,
        mixed $resourceId,
        string $relatedResourceClass,
        string $relationshipName
    ): TestResponse {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);
        $this->guardAgainstInvalidNovaResourceClass($relatedResourceClass);

        $uri = '/nova-api/' . $resourceClass::uriKey() . '/' . $resourceId . '/creation-pivot-fields/' . $relatedResourceClass::uriKey();
        $queryString = Arr::query(['editing' => 'true', 'editMode' => 'attach', 'viaRelationship' => $relationshipName]);

        return $this->getJson($uri . '?' . $queryString);
    }

    protected function getNovaResourcePivotUpdateFields(
        string $resourceClass,
        mixed $resourceId,
        string $relatedResourceClass,
        mixed $relatedResourceId,
        string $relationshipName
    ): TestResponse {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);
        $this->guardAgainstInvalidNovaResourceClass($relatedResourceClass);

        $uri = '/nova-api/' . $resourceClass::uriKey() . '/' . $resourceId . '/update-pivot-fields/' . $relatedResourceClass::uriKey() . '/' . $relatedResourceId;
        $queryString = Arr::query(['editing' => 'true', 'editMode' => 'update-attached', 'viaRelationship' => $relationshipName]);

        return $this->getJson($uri . '?' . $queryString);
    }
}
