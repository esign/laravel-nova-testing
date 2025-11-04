# Testing toolkit for Laravel Nova

[![Latest Version on Packagist](https://img.shields.io/packagist/v/esign/laravel-nova-testing.svg?style=flat-square)](https://packagist.org/packages/esign/laravel-nova-testing)
[![Total Downloads](https://img.shields.io/packagist/dt/esign/laravel-nova-testing.svg?style=flat-square)](https://packagist.org/packages/esign/laravel-nova-testing)
![GitHub Actions](https://github.com/esign/laravel-nova-testing/actions/workflows/run-tests.yml/badge.svg)

A toolkit for testing [Laravel Nova](https://nova.laravel.com/) routes and resources. This package provides convenient testing utilities to interact with Nova endpoints in your feature and integration tests.

## Installation

You can install the package via composer:

```bash
composer require esign/laravel-nova-testing
```

## Usage

### Getting Started

You may implement the `MakesNovaRequests` trait in your test cases to easily make requests to Nova routes and assert their responses.

```php
use Esign\NovaTesting\Concerns\MakesNovaRequests;

class ExampleTest extends TestCase
{
    use MakesNovaRequests;

    public function test_can_get_nova_resource_index()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getNovaResourceIndex(UserResource::class);

        $response->assertStatus(200);
    }
}
```

### Available Testing Methods

#### Resource Requests

- `getNovaResourceIndex($resourceClass)`
- `getNovaResourceDetail($resourceClass, $resourceId)`
- `createNovaResource($resourceClass, array $data)`
- `updateNovaResource($resourceClass, $resourceId, array $data)`
- `deleteNovaResource($resourceClass, array $resourceIds)`
- `forceDeleteNovaResource($resourceClass, array $resourceIds)`
- `restoreNovaResource($resourceClass, array $resourceIds)`
- `attachNovaResource($resourceClass, $resourceId, $relatedResourceClass, $relatedResourceId, $relationshipName, array $data = [])`
- `getNovaResourceCount($resourceClass)`
- `getNovaResourceFilters($resourceClass)`

#### Field Requests

- `getNovaResourceCreationFields($resourceClass)`
- `getNovaResourceUpdateFields($resourceClass, $resourceId)`
- `getNovaResourcePivotCreationFields($resourceClass, $resourceId, $relatedResourceClass, $relationshipName)`
- `getNovaResourcePivotUpdateFields($resourceClass, $resourceId, $relatedResourceClass, $relatedResourceId, $relationshipName)`

#### Action Requests

- `getNovaResourceActions($resourceClass)`
- `runNovaResourceAction($resourceClass, $action, array $data = [])`

#### Page Requests

- `getNovaHomePage()`
- `getNovaDashboardPage($dashboard)`
- `getNovaResourceIndexPage($resourceClass)`
- `getNovaResourceDetailPage($resourceClass, $resourceId)`
- `getNovaResourceCreatePage($resourceClass)`
- `getNovaResourceEditPage($resourceClass, $resourceId)`
- `getNovaResourceReplicatePage($resourceClass, $resourceId)`
- `getNovaResourceLensPage($resourceClass, $lens)`

#### Impersonation Requests

- `startNovaImpersonation($resourceClass, $resourceId)`
- `stopNovaImpersonation()`

## Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
