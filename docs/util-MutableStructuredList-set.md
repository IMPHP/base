# [Utilities](util.md) / [MutableStructuredList](util-MutableStructuredList.md) :: set
 > im\util\MutableStructuredList
____

## Description
Set the value on a positional key

Unlike `add()`, this will set the value for a specified key,
rather than just appending the value to the end.

 > Note that the key must be either an existing position or represent the end of the list. You cannot insert data into position `10`, if the list has a length of `7`.  

## Synopsis
```php
set(int $key, mixed $value): mixed
```

## Parameters
| Name | Description |
| :--- | :---------- |
| key | The key to set/change |
| value | The value to add. |

## Return
The current value
