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

class MakesNovaFieldRequests extends TestCase
{
    use LazilyRefreshDatabase;
    use MakesNovaRequests;

    #[Test]
    public function it_can_get_nova_resource_creation_fields(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->getNovaResourceCreationFields(resourceClass: UserResource::class);

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_get_nova_resource_update_fields(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->getNovaResourceUpdateFields(
            resourceClass: UserResource::class,
            resourceId: $user->getKey()
        );

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_get_nova_resource_pivot_creation_fields(): void
    {
        // Arrange
        $user = User::factory()->create();
        $role = Role::factory()->create();

        // Act
        $response = $this->actingAs($user)->getNovaResourcePivotCreationFields(
            resourceClass: UserResource::class,
            resourceId: $user->getKey(),
            relatedResourceClass: RoleResource::class,
            relationshipName: 'roles'
        );

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_get_nova_resource_pivot_update_fields(): void
    {
        // Arrange
        $role = Role::factory()->create();
        $user = User::factory()->hasAttached($role)->create();

        // Act
        $response = $this->actingAs($user)->getNovaResourcePivotUpdateFields(
            resourceClass: UserResource::class,
            resourceId: $user->getKey(),
            relatedResourceClass: RoleResource::class,
            relatedResourceId: $role->getKey(),
            relationshipName: 'roles'
        );

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $response->assertStatus(200);
    }
}
