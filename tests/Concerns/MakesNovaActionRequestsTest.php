<?php

namespace Esign\LaravelNovaTesting\Tests\Concerns;

use Esign\NovaTesting\Concerns\MakesNovaRequests;
use Esign\NovaTesting\Tests\TestCase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Attributes\Test;
use Workbench\App\Models\User;
use Workbench\App\Nova\Resources\User as UserResource;

class MakesNovaActionRequestsTest extends TestCase
{
    use LazilyRefreshDatabase;
    use MakesNovaRequests;

    #[Test]
    public function it_can_get_nova_resource_actions(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->getNovaResourceActions(UserResource::class);

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $response->assertStatus(200);
        $response->assertJsonStructure(['actions']);
    }

    #[Test]
    public function it_can_run_a_nova_resource_action(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->runNovaResourceAction(
            resourceClass: UserResource::class,
            action: 'my-action',
            data: [
                'resources' => [$user->getKey()],
            ]
        );

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $response->assertStatus(200);
    }
}
