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

- `getNovaResourceIndex($resourceClass, array $query = [], array $filters = [])`
- `getNovaResourceDetail($resourceClass, $resourceId, array $query = [])`
- `createNovaResource($resourceClass, array $data, array $query = [])`
- `updateNovaResource($resourceClass, $resourceId, array $data, array $query = [])`
- `deleteNovaResource($resourceClass, array $resourceIds, array $query = [])`
- `forceDeleteNovaResource($resourceClass, array $resourceIds, array $query = [])`
- `restoreNovaResource($resourceClass, array $resourceIds, array $query = [])`
- `attachNovaResource($resourceClass, $resourceId, $relatedResourceClass, $relatedResourceId, $relationshipName, array $data = [], array $query = [])`
- `getNovaResourceCount($resourceClass, array $query = [])`
- `getNovaResourceFilters($resourceClass, array $query = [])`

#### Field Requests

- `getNovaResourceCreationFields($resourceClass, array $query = [])`
- `getNovaResourceUpdateFields($resourceClass, $resourceId, array $query = [])`
- `getNovaResourcePivotCreationFields($resourceClass, $resourceId, $relatedResourceClass, $relationshipName, array $query = [])`
- `getNovaResourcePivotUpdateFields($resourceClass, $resourceId, $relatedResourceClass, $relatedResourceId, $relationshipName, array $query = [])`
- `patchNovaResourceUpdateFields($resourceClass, $resourceId, $field, $component, array $data, array $query = [])`
- `deleteNovaResourceField($resourceClass, $resourceId, $field, array $query = [])`

#### Associatable Requests

- `getNovaAssociatable($resourceClass, $field, $resourceId, $component, $search = '', array $query = [])`

#### Action Requests

- `getNovaResourceActions($resourceClass, array $query = [])`
- `runNovaResourceAction($resourceClass, $action, array $data = [], array $query = [])`

#### Dashboard Requests

- `getNovaDashboard($dashboard, array $query = [])`
- `getNovaDashboardCards($dashboard, array $query = [])`
- `getNovaDashboardMetric($dashboard, $metric, array $query = [])`

#### Page Requests

- `getNovaHomePage(array $query = [])`
- `getNovaDashboardPage($dashboard, array $query = [])`
- `getNovaResourceIndexPage($resourceClass, array $query = [])`
- `getNovaResourceDetailPage($resourceClass, $resourceId, array $query = [])`
- `getNovaResourceCreatePage($resourceClass, array $query = [])`
- `getNovaResourceEditPage($resourceClass, $resourceId, array $query = [])`
- `getNovaResourceReplicatePage($resourceClass, $resourceId, array $query = [])`
- `getNovaResourceLensPage($resourceClass, $lens, array $query = [])`

#### Impersonation Requests

- `startNovaImpersonation($resourceClass, $resourceId, array $query = [])`
- `stopNovaImpersonation(array $query = [])`

## Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
