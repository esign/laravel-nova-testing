<?php

namespace Esign\NovaTesting\Tests\Concerns;

use Esign\NovaTesting\Concerns\MakesNovaRequests;
use Esign\NovaTesting\Tests\TestCase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Attributes\Test;
use Workbench\App\Models\Role;
use Workbench\App\Models\User;
use Workbench\App\Nova\Resources\User as UserResource;

class MakesNovaAssociatableRequestsTest extends TestCase
{
    use LazilyRefreshDatabase;
    use MakesNovaRequests;

    #[Test]
    public function it_can_search_for_associatable_resources(): void
    {
        // Arrange
        $user = User::factory()->create();
        Role::factory()->create(['name' => 'Administrator']);
        Role::factory()->create(['name' => 'Guest']);

        // Act - search for "Ad" (partial match for Administrator)
        $response = $this->actingAs($user)->getNovaAssociatable(
            resourceClass: UserResource::class,
            field: 'role',
            resourceId: $user->getKey(),
            component: 'belongsto.belongs-to-field.role',
            search: 'Ad'
        );

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $response->assertStatus(200);
        $this->assertContains('Administrator', $response->json('resources.*.display'));
        $this->assertNotContains('Guest', $response->json('resources.*.display'));
    }
}
