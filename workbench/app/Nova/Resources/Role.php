<?php

namespace Workbench\App\Nova\Resources;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Role extends Resource
{
    public static $model = \Workbench\App\Models\Role::class;

    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),
        ];
    }

    public function title(): string
    {
        return $this->name;
    }

    public static function searchableColumns(): array
    {
        return [
            'name',
        ];
    }
}
