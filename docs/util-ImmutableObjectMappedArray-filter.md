# [Utilities](util.md) / [ImmutableObjectMappedArray](util-ImmutableObjectMappedArray.md) :: filter
 > im\util\ImmutableObjectMappedArray
____

## Description
Filters elements of the collection

## Synopsis
```php
filter(callable $filter): static
```

## Parameters
| Name | Description |
| :--- | :---------- |
| filter | A `callable(mixed $key, mixed $value): bool`.<br /><br />This will be called on each value in the dataset.<br />If the `callable` returns `false`, the value will not be copied<br />to the new collection and if the `callable` returns `true` then it will. |
