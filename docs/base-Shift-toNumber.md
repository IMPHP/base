# [Base](base.md) / [Shift](base-Shift.md) :: toNumber
 > im\Shift
____

## Description
Convert a value to a proper number.

This method can convert things like a binary string `0b001101` or
a hex string `0x5f80` to an integer. It can also convert strings with regular numbers
like `1.487` or `2.24e+10`, or booleans to `1` and `0`, empty string or `null` to `0` and so on.

## Synopsis
```php
public static toNumber(mixed $data): int|float
```

## Parameters
| Name | Description |
| :--- | :---------- |
| data | The value to convert. |
