<?php

namespace Workbench\App\Nova\Filters;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Laravel\Nova\Filters\BooleanFilter;
use Laravel\Nova\Http\Requests\NovaRequest;

class UserHasNote extends BooleanFilter
{
    public function name(): string
    {
        return 'Has Note';
    }

    public function apply(NovaRequest $request, Builder $query, mixed $value): Builder
    {
        $checked = array_keys(array_filter($value));

        return count($checked) === 1
            ? $query->where('has_note', (int) $checked[0])
            : $query;
    }

    public function options(NovaRequest $request): array
    {
        return [
            'Yes' => 1,
            'No' => 0,
        ];
    }
}
