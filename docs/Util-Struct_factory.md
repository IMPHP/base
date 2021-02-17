# [Util](Util.md) / [Struct](Util-Struct.md) :: factory
 > im\util\Struct
____

## Description
Create a `Struct` with multiple keys already initialized.

## Synopsis
```php
static factory(string $keys): static
```

## Parameters
| Name | Description |
| :--- | :---------- |
| keys | Keys to initialize |

## Return
A new instance with specified keys initialized

## Example 1
```php
$struct = Struct::factory("key1", "key2");
$struct->key1 = "Some value";
$struct->key2 = "Some value";
```
