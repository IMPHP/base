# [Utilities](util.md) / [Vector](util-Vector.md) :: set
 > im\util\Vector
____

## Description
Set the value on a positional key

Unlike `add()`, this will set the value for a specified key,
rather than just appending the value to the end.

 > Note that the key must be either an existing position or represent the end of the list. You cannot insert data into position `10`, if the list has a length of `7`.  

## Synopsis
```php
public set(int $key, mixed $value): void
```

## Parameters
| Name | Description |
| :--- | :---------- |
| key | The key to set/change |
| value | The value to add. |
