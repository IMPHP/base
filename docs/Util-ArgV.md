# [Base](Base.md) / [Util](Util.md) / ArgV
 > im\util\ArgV
____

## Description
This class provides a unified API to deal with shell arguments (argv)

## Synopsis
```php
class ArgV {

    // Methods
    __construct(array $args = null, array $validFlags = []): mixed
    getScriptName(): ?string
    getScriptPath(): ?string
    getFlags(): im\util\Vector
    hasFlag(string $char): bool
    getOptions(): im\util\MapArray
    hasOption(string $name): bool
    getOption(string $name): ?string
    getOptionAsList(string $name): im\util\IndexArray
    getOperands(): im\util\IndexArray
    getOperand(int $pos): ?string
    getOperandCount(): int
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__ArgV&nbsp;::&nbsp;\_\_construct__](Util-ArgV___construct.md) |  |
| [__ArgV&nbsp;::&nbsp;getScriptName__](Util-ArgV_getScriptName.md) | Get the name of the file that was executed |
| [__ArgV&nbsp;::&nbsp;getScriptPath__](Util-ArgV_getScriptPath.md) | Get the absolut path to the file that was executed |
| [__ArgV&nbsp;::&nbsp;getFlags__](Util-ArgV_getFlags.md) | Get all the flags that was passed |
| [__ArgV&nbsp;::&nbsp;hasFlag__](Util-ArgV_hasFlag.md) | Check to see if a specific flag was passed |
| [__ArgV&nbsp;::&nbsp;getOptions__](Util-ArgV_getOptions.md) | Get all of the options that was passed |
| [__ArgV&nbsp;::&nbsp;hasOption__](Util-ArgV_hasOption.md) | Check to see if an option is available. |
| [__ArgV&nbsp;::&nbsp;getOption__](Util-ArgV_getOption.md) | Get the value from an option. |
| [__ArgV&nbsp;::&nbsp;getOptionAsList__](Util-ArgV_getOptionAsList.md) | Get values from an option as a list |
| [__ArgV&nbsp;::&nbsp;getOperands__](Util-ArgV_getOperands.md) | Get a list of all of the operands |
| [__ArgV&nbsp;::&nbsp;getOperand__](Util-ArgV_getOperand.md) | Get a specific operand by it's position relative to all passed operands. |
| [__ArgV&nbsp;::&nbsp;getOperandCount__](Util-ArgV_getOperandCount.md) | Get the number of operands |

## Example 1
```sh
command -abc --flag --opt1 val1 opt2=val2 -d instr1 --opt3[] val3 opt3[]=val4 -- instr2 --opt5 val5
```

```php
[
    "flags" => ['a' => true, 'b' => true, 'c' => true, 'flag' => true, 'd' => true],
    "options" => [
        "opt1" => "val1",
        "opt2" => "val2",
        "opt3" => ["val3", "val4"]
    ],
    "operands" => ["instr1", "instr2", "--opt5", "val5"]
];
```
