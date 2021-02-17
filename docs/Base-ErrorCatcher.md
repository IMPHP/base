# [Base](Base.md) / ErrorCatcher
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

    // Methods
    __construct(bool $throwOnError = true): mixed
    run(callable $callable): mixed
    getException(): ?Throwable
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__ErrorCatcher&nbsp;::&nbsp;\_\_construct__](Base-ErrorCatcher___construct.md) |  |
| [__ErrorCatcher&nbsp;::&nbsp;run__](Base-ErrorCatcher_run.md) | Try running a callable. |
| [__ErrorCatcher&nbsp;::&nbsp;getException__](Base-ErrorCatcher_getException.md) | Get the exception from last run |
