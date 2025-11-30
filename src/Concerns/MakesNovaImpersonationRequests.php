<?php

namespace Esign\NovaTesting\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;

trait MakesNovaImpersonationRequests
{
    public function startNovaImpersonation(string $resourceClass, mixed $resourceId, array $query = []): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->postJson('/nova-api/impersonate?' . Arr::query($query), [
            'resource' => $resourceClass::uriKey(),
            'resourceId' => $resourceId,
        ]);
    }

    public function stopNovaImpersonation(array $query = []): TestResponse
    {
        return $this->deleteJson('/nova-api/impersonate?' . Arr::query($query));
    }
}
