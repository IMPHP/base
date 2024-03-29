# [Utilities](util.md) / [ArgV](util-ArgV.md) :: getOptionAsList
 > im\util\ArgV
____

## Description
Get values from an option as a list

This will always return a list of values, even if there is
only one value or none at all.

## Synopsis
```php
public getOptionAsList(string $name): im\util\MutableStructuredList
```

## Parameters
| Name | Description |
| :--- | :---------- |
| name | The name of the option.<br />This does not include any '--' that may have been used. |

## Return
Always returns a list
