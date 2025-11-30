## From v1 to v2

### Method changes
- All requests now allow a `$query` parameter to pass additional query parameters to the request.
- The parameter order of the `getNovaResourceIndex` method has changed. The `$query` parameter is now the second parameter, and `$filters` is the third parameter.

```diff
- $this->getNovaResourceIndex(MyResource::class, ['status' => 'active']);
+ $this->getNovaResourceIndex(MyResource::class, [], ['status' => 'active']);
```