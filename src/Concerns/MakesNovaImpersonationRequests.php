<?php

namespace Esign\NovaTesting\Concerns;

use Illuminate\Testing\TestResponse;

trait MakesNovaImpersonationRequests
{
    public function startNovaImpersonation(string $resourceClass, mixed $resourceId): TestResponse
    {
        $this->guardAgainstInvalidNovaResourceClass($resourceClass);

        return $this->postJson('/nova-api/impersonate', [
            'resource' => $resourceClass::uriKey(),
            'resourceId' => $resourceId,
        ]);
    }

    public function stopNovaImpersonation(): TestResponse
    {
        return $this->deleteJson('/nova-api/impersonate');
    }
}
