<?php

namespace Esign\NovaTesting\Tests\Concerns;

use Esign\NovaTesting\Concerns\MakesNovaRequests;
use Esign\NovaTesting\Tests\TestCase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Attributes\Test;
use Workbench\App\Models\Role;
use Workbench\App\Models\User;
use Workbench\App\Nova\Resources\Role as RoleResource;
use Workbench\App\Nova\Resources\User as UserResource;

class MakesNovaResourceRequestsTest extends TestCase
{
    use LazilyRefreshDatabase;
    use MakesNovaRequests;

    #[Test]
    public function it_can_get_a_nova_resource_index(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->getNovaResourceIndex(resourceClass: UserResource::class);

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_get_a_nova_resource(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->getNovaResourceDetail(
            resourceClass: UserResource::class,
            resourceId: $user->getKey()
        );

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

    #[Test]
    public function it_can_force_delete_a_nova_resource(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->forceDeleteNovaResource(
            resourceClass: UserResource::class,
            resourceIds: [$user->getKey()],
        );

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_restore_a_nova_resource(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->restoreNovaResource(
            resourceClass: UserResource::class,
            resourceId: $user->getKey(),
        );

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_attach_a_nova_resource(): void
    {
        // Arrange
        $user = User::factory()->create();
        $role = Role::factory()->create();

        // Act
        $response = $this->actingAs($user)->attachNovaResource(
            resourceClass: UserResource::class,
            resourceId: $user->getKey(),
            relatedResourceClass: RoleResource::class,
            relatedResourceId: $role->getKey(),
            relationshipName: 'roles',
            data: []
        );

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_get_a_nova_resource_count(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->getNovaResourceCount(resourceClass: UserResource::class);

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $response->assertStatus(200);
    }

    public function it_can_get_nova_resource_filters(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->getNovaResourceFilters(resourceClass: UserResource::class);

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $response->assertStatus(200);
    }
}
