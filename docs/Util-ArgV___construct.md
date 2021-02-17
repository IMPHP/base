# [Util](Util.md) / [ArgV](Util-ArgV.md) :: __construct
 > im\util\ArgV
____

## Synopsis
```php
__construct(array $args = null, array $validFlags = []): mixed
```

## Parameters
| Name | Description |
| :--- | :---------- |
| args | Optional argv. Defaults to PHP's $argv. |
| validFlags | By default only character flags '-f' are supported.<br />To enable something like '--help', you must specify ['--help']<br />in this argument. Otherwise '--help' will be seen as an option and<br />the next part will be seen as the value of '--help'. |
