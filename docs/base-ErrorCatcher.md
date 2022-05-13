# [Base](base.md) / ErrorCatcher
 > im\ErrorCatcher
____

## Description
Try running some code while catching any errors.

This class can be used to catch errors, warning and exceptions
while trying to run some code. The main objective here, is to
catch internal errors and warnings that is triggered by some of the old-school
code in PHP, rather than having it printet to stdout.

## Synopsis
```php
class ErrorCatcher {

    // Constants
    public T_HALT = 1
    public T_THROW = 3

    // Methods
    public __construct(int $onError = im\ErrorCatcher::T_HALT)
    public run(callable $callable): mixed
    public getException(): null|Throwable
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__ErrorCatcher&nbsp;::&nbsp;T\_HALT__](base-ErrorCatcher-prop_T_HALT.md) | Halt execution on the first PHP error |
| [__ErrorCatcher&nbsp;::&nbsp;T\_THROW__](base-ErrorCatcher-prop_T_THROW.md) | Halt and throw exception on the first PHP error |

## Methods
| Name | Description |
| :--- | :---------- |
| [__ErrorCatcher&nbsp;::&nbsp;\_\_construct__](base-ErrorCatcher-__construct.md) |  |
| [__ErrorCatcher&nbsp;::&nbsp;run__](base-ErrorCatcher-run.md) | Try running a callable |
| [__ErrorCatcher&nbsp;::&nbsp;getException__](base-ErrorCatcher-getException.md) | Get the exception from last run |
