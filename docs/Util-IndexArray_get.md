# [Util](Util.md) / [IndexArray](Util-IndexArray.md) :: get
 > im\util\IndexArray
____

## Description
Returns the value for a positional key

## Synopsis
```php
get(int $key, mixed $defVal = null): mixed
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
