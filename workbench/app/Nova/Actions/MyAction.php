<?php

namespace Workbench\App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class MyAction extends Action implements ShouldQueue
{
    use Queueable;

    public $name = 'My Action';

    public function handle(ActionFields $fields, Collection $models)
    {
        return Action::message('MyAction executed successfully!');
    }

    public function uriKey()
    {
        return 'my-action';
    }

    public function fields(NovaRequest $request)
    {
        return [];
    }
}
