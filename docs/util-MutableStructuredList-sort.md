# [Utilities](util.md) / [MutableStructuredList](util-MutableStructuredList.md) :: sort
 > im\util\MutableStructuredList
____

## Description
Sort the collection by value

## Synopsis
```php
sort(callable $filter): void
```

## Parameters
| Name | Description |
| :--- | :---------- |
| filter | A `callable(mixed $value_a, mixed $value_b): int`.<br /><br />The comparison function must return an integer less than, equal to, or greater than zero<br />if the first argument is considered to be respectively less than, equal to, or greater than the second. |
