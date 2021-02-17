# [Util](Util.md) / [Struct](Util-Struct.md) :: setOnInvoke
 > im\util\Struct
____

## Description
Add a callable that will be called when trying to access this
instance as a function.

## Synopsis
```php
setOnInvoke(callable $callable): static
```

## Parameters
| Name | Description |
| :--- | :---------- |
| callable | A callable to be invoked. |

## Example 1
```php
$struct = new Struct();
$struct->setOnInvoke(function(){
     // Action to perform
});

$struct(); // Invoke the function
```
