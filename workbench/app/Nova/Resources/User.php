<?php

namespace Workbench\App\Nova\Resources;

use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Workbench\App\Nova\Actions\MyAction;
use Workbench\App\Nova\Filters\UserHasNoteFilter;
use Workbench\App\Nova\Lenses\MyLens;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\Workbench\App\Models\User>
     */
    public static $model = \Workbench\App\Models\User::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array<int, \Laravel\Nova\Fields\Field|\Laravel\Nova\Panel|\Laravel\Nova\ResourceTool|\Illuminate\Http\Resources\MergeValue>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            Avatar::make('Avatar')->disk('public'),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms(),

            Boolean::make('Has note', 'has_note'),

            Text::make('Note', 'note')
                ->dependsOn(
                    ['has_note'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        $formData->boolean('has_note') ? $field->show() : $field->hide();
                    }
                ),


            BelongsToMany::make('Roles', 'roles', Role::class),
        ];
    }

    public function filters(NovaRequest $request)
    {
        return [
            UserHasNoteFilter::make(),
        ];
    }

    public function lenses(NovaRequest $request)
    {
        return [
            MyLens::make(),
        ];
    }

    public function actions(NovaRequest $request)
    {
        return [
            MyAction::make(),
        ];
    }
}
