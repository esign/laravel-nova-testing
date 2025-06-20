<?php

namespace Esign\NovaTesting\Facades;

use Illuminate\Support\Facades\Facade;

class NovaTestingFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'nova-testing';
    }
}
