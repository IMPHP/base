# [Utilities](util.md) / [ArgV](util-ArgV.md) :: getOption
 > im\util\ArgV
____

## Description
Get the value from an option.

This will not return multiple values if an option was passed with
multiple values. In that case it will return the first value.

## Synopsis
```php
public getOption(string $name): null|string
```

## Parameters
| Name | Description |
| :--- | :---------- |
| name | The name of the option.<br />This does not include any '--' that may have been used. |

## Return
The value if the option exist or `null` if it doesn't
