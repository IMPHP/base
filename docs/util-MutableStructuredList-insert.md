# [Utilities](util.md) / [MutableStructuredList](util-MutableStructuredList.md) :: insert
 > im\util\MutableStructuredList
____

## Description
Insert a value into a positional key

Unlike `set()` this will not override the existing
value. Instead it will move the data in that position and in front of it,
and add the value in between.

## Synopsis
```php
insert(int $key, mixed $value): bool
```

## Parameters
| Name | Description |
| :--- | :---------- |
| key | The key to insert into. |
| value | The value to insert. |

## Return
Returns `TRUE` on success or `FALSE` if `$key` was out of range
