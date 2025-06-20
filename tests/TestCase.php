<?php

namespace Esign\NovaTesting\Tests;

use Esign\NovaTesting\NovaTestingServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [NovaTestingServiceProvider::class];
    }
} 