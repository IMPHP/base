# [Utilities](util.md) / [Vector](util-Vector.md) :: get
 > im\util\Vector
____

## Description
Returns the value for a positional key

## Synopsis
```php
public get(int $key, mixed $defVal = NULL): mixed
```

## Parameters
| Name | Description |
| :--- | :---------- |
| key | The key to get. |
| defVal | Default value when the key does not exist. |

## Return
This will return `null` or `$defVal` if the
key does not exist. It also returns `$defVal`
if the value is `null`.
