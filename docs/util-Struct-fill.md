# [Utilities](util.md) / [Struct](util-Struct.md) :: fill
 > im\util\Struct
____

## Description
Fill all initialized keys with values.

## Synopsis
```php
public fill(mixed ...$values): static
```

## Parameters
| Name | Description |
| :--- | :---------- |
| values | Values to assign |

## Return
Returns the same instance

## Example 1
```php
$struct = Struct::factory("key1", "key2");
$struct->fill("Some value", "Some value");
```
