<?php

namespace Esign\NovaTesting\Tests\Concerns;

use Esign\NovaTesting\Concerns\MakesNovaRequests;
use Esign\NovaTesting\Tests\TestCase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Attributes\Test;
use Workbench\App\Models\User;
use Workbench\App\Nova\Resources\User as UserResource;

final class MakesNovaImpersonationRequestsTest extends TestCase
{
    use LazilyRefreshDatabase;
    use MakesNovaRequests;

    #[Test]
    public function it_can_start_impersonation(): void
    {
        // Arrange
        $adminUser = User::factory()->create();
        $targetUser = User::factory()->create();

        // Act
        $response = $this->actingAs($adminUser)->startNovaImpersonation(
            resourceClass: UserResource::class,
            resourceId: $targetUser->getKey(),
        );

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $this->assertAuthenticatedAs($targetUser);
        $response->assertStatus(200);
        $response->assertJsonStructure(['redirect']);
    }

    #[Test]
    public function it_can_stop_impersonation(): void
    {
        // Arrange
        $adminUser = User::factory()->create();
        $targetUser = User::factory()->create();

        // Start impersonation first
        $this->actingAs($adminUser)->startNovaImpersonation(
            resourceClass: UserResource::class,
            resourceId: $targetUser->getKey(),
        );

        // Act
        $response = $this->stopNovaImpersonation();

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $this->assertAuthenticatedAs($adminUser);
        $response->assertStatus(200);
        $response->assertJsonStructure(['redirect']);
    }
}
