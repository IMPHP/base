# [Utilities](util.md) / [ArgV](util-ArgV.md) :: getOperand
 > im\util\ArgV
____

## Description
Get a specific operand by it's position relative to all passed operands.

An operand is one that is passed alone. That means an argument that was not
passed as a flag '-f' or as an option '--name val'.

The position of an operand is only counted from another operand and not
from any options or the script name.

For an example:
```sh
cmd -d --name val operand
```
Here the position of 'operand' would be '0' or '-1' if you go for the last one.

## Synopsis
```php
public getOperand(int $pos): null|string
```

## Parameters
| Name | Description |
| :--- | :---------- |
| pos | Position of the operand. May be negative integer to go from right to left. |

## Return
The operand or `null` if it does not exist
