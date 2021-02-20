# [Utilities](util.md) / [ArgV](util-ArgV.md) :: hasFlag
 > im\util\ArgV
____

## Description
Check to see if a specific flag was passed

A flag is one that was passed as `-f`.
It can also be part of miltiple flags `-fg` where
`f` would be one flag and `g` another.

## Synopsis
```php
public hasFlag(string $char): bool
```

## Parameters
| Name | Description |
| :--- | :---------- |
| char | The flag character.<br />This does not include the '-' character |

## Return
Returns `true` if the flag is available or `false` otherwise
