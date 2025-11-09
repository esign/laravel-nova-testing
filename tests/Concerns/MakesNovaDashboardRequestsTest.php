<?php

namespace Esign\NovaTesting\Tests\Concerns;

use Esign\NovaTesting\Concerns\MakesNovaRequests;
use Esign\NovaTesting\Tests\TestCase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Attributes\Test;
use Workbench\App\Models\User;

final class MakesNovaDashboardRequestsTest extends TestCase
{
    use LazilyRefreshDatabase;
    use MakesNovaRequests;

    #[Test]
    public function it_can_get_a_nova_dashboard(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->getNovaDashboard('my-dashboard');

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_get_nova_dasbhoard_cards(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->getNovaDashboardCards('my-dashboard');

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $response->assertStatus(200);
        $response->assertJsonPath('0.uriKey', 'new-users');
    }

    #[Test]
    public function it_can_get_nova_dashboard_metrics(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $response = $this->actingAs($user)->getNovaDashboardMetric('my-dashboard', 'new-users');

        // Assert
        $this->assertInstanceOf(TestResponse::class, $response);
        $response->assertStatus(200);
        $response->assertJsonPath('value.value', 1);
    }
}
