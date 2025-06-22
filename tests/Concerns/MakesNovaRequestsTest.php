<?php

namespace Esign\NovaTesting\Tests\Concerns;

use Esign\NovaTesting\Concerns\MakesNovaRequests;
use Esign\NovaTesting\Tests\TestCase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;

final class MakesNovaRequestsTest extends TestCase
{
    use LazilyRefreshDatabase;
    use MakesNovaRequests;

    #[Test]
    public function it_can_throw_an_exception_when_an_invalid_resource_is_passed(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The resource class [InvalidResource] must be a subclass of [Laravel\Nova\Resource]');

        $this->guardAgainstInvalidNovaResourceClass('InvalidResource');
    }
}
