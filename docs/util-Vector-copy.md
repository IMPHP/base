# [Utilities](util.md) / [Vector](util-Vector.md) :: copy
 > im\util\Vector
____

## Description
Clone this instance and return it.

> :warning: **Deprecated**  
> This has been replaced by `clone()` and `filter()`, where the later is collection type specific.  

## Synopsis
```php
public copy(null|callable $sort = NULL): static
```

## Parameters
| Name | Description |
| :--- | :---------- |
| sort | An optional `callable(mixed $key, mixed $value)`.<br /><br />This will be called on each value when copying a collection.<br />If the `callable` returns `false`, the value will not be copied<br />to the new collection and if the `callable` returns `true` then it will. |

## Return
Returns a cloned version of this instance.
