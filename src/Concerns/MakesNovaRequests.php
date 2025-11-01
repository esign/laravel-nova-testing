<?php

namespace Esign\NovaTesting\Concerns;

use InvalidArgumentException;
use Laravel\Nova\Resource as NovaResource;

trait MakesNovaRequests
{
    use MakesNovaActionRequests;
    use MakesNovaFieldRequests;
    use MakesNovaResourceRequests;
    use MakesNovaPageRequests;

    protected function guardAgainstInvalidNovaResourceClass(string $resourceClass): void
    {
        if (! is_subclass_of($resourceClass, NovaResource::class)) {
            throw new InvalidArgumentException(sprintf('The resource class [%s] must be a subclass of [%s]', $resourceClass, NovaResource::class));
        }
    }
}
