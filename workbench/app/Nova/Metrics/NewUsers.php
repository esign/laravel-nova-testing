<?php

namespace Workbench\App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;
use Laravel\Nova\Metrics\ValueResult;
use Laravel\Nova\Nova;
use Workbench\App\Models\User;

class NewUsers extends Value
{
    public function calculate(NovaRequest $request): ValueResult
    {
        return $this->count($request, User::class);
    }

    public function ranges(): array
    {
        return [
            30 => Nova::__('30 Days'),
            60 => Nova::__('60 Days'),
            365 => Nova::__('365 Days'),
        ];
    }
}
