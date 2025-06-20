<?php

namespace Esign\NovaTesting\Tests;

use Esign\NovaTesting\MakesNovaRequests;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Testing\TestResponse;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Workbench\App\Models\User as User;
use Workbench\App\Nova\User as UserResource;

final class MakesNovaRequestsTest extends TestCase
{
    use LazilyRefreshDatabase;
    use MakesNovaRequests;

    #[Test]
    public function it_can_throw_an_exception_when_an_invalid_resource_is_passed(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The resource class must be a subclass of Laravel\Nova\Resource');

        $this->guardAgainstInvalidResourceClass('InvalidResource');
    }

    #[Test]
    public function it_can_get_a_nova_resource_index(): void
    {
        // Arrange
        $user = User::factory()->create(['name' => 'Test User']);

        // Act
        $response = $this->actingAs($user)->getNovaResourceIndex(resourceClass: UserResource::class);

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_create_a_nova_resource(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->createNovaResource(
            resourceClass: UserResource::class,
            data: [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => 'top-secret',
            ]
        );

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $response->assertStatus(201);
    }

    #[Test]
    public function it_can_update_a_nova_resource(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->updateNovaResource(
            resourceClass: UserResource::class,
            resourceId: $user->getKey(),
            data: [
                'name' => 'John Doe',
                'email' => 'john@example.com',
            ]
        );

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_delete_a_nova_resource(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->deleteNovaResource(
            resourceClass: UserResource::class,
            resourceIds: [$user->getKey()],
        );

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $response->assertStatus(200);
    }
}
