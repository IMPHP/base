# [Utilities](util.md) / [HashSet](util-HashSet.md) :: filter
 > im\util\HashSet
____

## Description
Filters elements of the collection

## Synopsis
```php
public filter(callable $filter): static
```

## Parameters
| Name | Description |
| :--- | :---------- |
| filter | A `callable(mixed $value): bool`.<br /><br />This will be called on each value in the dataset.<br />If the `callable` returns `false`, the value will not be copied<br />to the new collection and if the `callable` returns `true` then it will. |
