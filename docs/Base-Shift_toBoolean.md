# [Base](Base.md) / [Shift](Base-Shift.md) :: toBoolean
 > im\Shift
____

## Description
Convert a value to a proper boolean.

This can convert numbers to boolean or
strings like `1`, `true`, `on`, `yes` and so on.

This can be particular useful when dealing with php.ini configurations,
since it does not have much standards in this regard.

## Synopsis
```php
static toBoolean(mixed $data): bool
```

## Parameters
| Name | Description |
| :--- | :---------- |
| data | The value to convert. |
