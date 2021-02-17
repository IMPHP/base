# [Base](Base.md) / [ErrorCatcher](Base-ErrorCatcher.md) :: run
 > im\ErrorCatcher
____

## Description
Try running a callable.

This method will return whatever value is returned by the callback on success.
If an error or warning is triggered, an `ErrorException` will be provided
with the information from the error. If an exception is trown inside the code, the
trown exception will be provided.

## Synopsis
```php
run(callable $callable): mixed
```

## Parameters
| Name | Description |
| :--- | :---------- |
| callable | A `callable` to run. |

## Return
Returns the value that was returned from the callable or `NULL`
if it failed due to an error. You can check `getException`
to see if there was an error. 
