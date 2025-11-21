<?php

namespace Workbench\App\Nova\Filters;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Laravel\Nova\Filters\BooleanFilter;
use Laravel\Nova\Http\Requests\NovaRequest;

class UserHasNoteFilter extends BooleanFilter
{
    public function name(): string
    {
        return 'Has Note';
    }

    public function apply(NovaRequest $request, Builder $query, mixed $value): Builder
    {
        return $query->where('has_note', $value['has_note']);
    }

    public function options(NovaRequest $request): array
    {
        return [
            'Has Note' => 'has_note',
        ];
    }
}
