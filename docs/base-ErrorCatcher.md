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

    // Methods
    public __construct(bool $throwOnError = TRUE)
    public run(callable $callable): mixed
    public getException(): null|Throwable
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__ErrorCatcher&nbsp;::&nbsp;\_\_construct__](base-ErrorCatcher-__construct.md) |  |
| [__ErrorCatcher&nbsp;::&nbsp;run__](base-ErrorCatcher-run.md) | Try running a callable |
| [__ErrorCatcher&nbsp;::&nbsp;getException__](base-ErrorCatcher-getException.md) | Get the exception from last run |
