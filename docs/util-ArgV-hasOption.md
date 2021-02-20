# [Utilities](util.md) / [ArgV](util-ArgV.md) :: hasOption
 > im\util\ArgV
____

## Description
Check to see if an option is available.

An option is one that was passed as `--name value` or
`name=value`. It may also be multiple values using
`--name[] val1 --name[] val2` or `name[]=val1 name[]=val2`.

## Synopsis
```php
public hasOption(string $name): bool
```

## Parameters
| Name | Description |
| :--- | :---------- |
| name | The name of the option.<br />This does not include any '--' that may have been used. |

## Return
Returns `true` if the option is available or `false` otherwise
