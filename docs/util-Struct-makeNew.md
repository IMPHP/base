# [Utilities](util.md) / [Struct](util-Struct.md) :: makeNew
 > im\util\Struct
____

## Description
Create a new instance with the same initialized keys.

## Synopsis
```php
public makeNew(mixed ...$values): static
```

## Parameters
| Name | Description |
| :--- | :---------- |
| values | Values to assign |

## Return
The new instance

## Example 1
```php
$struct = Struct::factory("key1", "key2");
$struct->fill("Some value", "Some value");
$struct2 = $struct->makeNew("Some new value", "Some new value");

$struct->key1 // Some value
$struct2->key1 // Some new value
```
