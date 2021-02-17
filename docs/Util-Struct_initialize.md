# [Util](Util.md) / [Struct](Util-Struct.md) :: initialize
 > im\util\Struct
____

## Description
Initialize a single key.

This allows you to initialize a single key, after the object
has been created.

## Synopsis
```php
initialize(string $key): void
```

## Parameters
| Name | Description |
| :--- | :---------- |
| key | The key to initialize |

## Example 1
```php
$struct = new Struct();
$struct->initialize("myKey");
$struct->myKey = "Some value";
```
