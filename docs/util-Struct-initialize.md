# [Utilities](util.md) / [Struct](util-Struct.md) :: initialize
 > im\util\Struct
____

## Description
Initialize a single key.

This allows you to initialize a single key, after the object
has been created.

## Synopsis
```php
public initialize(string $key): void
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
