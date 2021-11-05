# [Utilities](util.md) / [IndexArray](util-IndexArray.md) :: traverse
 > im\util\IndexArray
____

## Description
Traverses the dataset.

This method will traverse the dataset and call the
callable on each key/value.

 > This method should not be abused due to lazyness. It's convenient at some times, but it's important to be aware that this is not a very optimized way to access the data. A manual `loop` is prefered in most cases.  

## Synopsis
```php
traverse(callable $func): bool
```

## Parameters
| Name | Description |
| :--- | :---------- |
| func | A `function(mixed $key, mixed $value): bool` to call on each key/value.<br />If the function returns `FALSE`, further traversal will be terminated. |

## Return
This method will return `FALSE` if the traversal was terninated by the `callable`.
Otherwise it will return `TRUE`.
