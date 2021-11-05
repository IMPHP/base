# [Base](base.md) / [Utilities](util.md) / ArgV
 > im\util\ArgV
____

## Description
This class provides a unified API to deal with shell arguments (argv)

## Synopsis
```php
class ArgV implements Stringable {

    // Methods
    public __construct(null|array $args = NULL, array $validFlags = Array)
    public getScriptName(): null|string
    public getScriptPath(): null|string
    public getFlags(): im\util\MutableStructuredList
    public hasFlag(string $char): bool
    public getOptions(): im\util\MutableStringMappedArray
    public hasOption(string $name): bool
    public getOption(string $name): null|string
    public getOptionAsList(string $name): im\util\MutableStructuredList
    public getOperands(): im\util\MutableStructuredList
    public getOperand(int $pos): null|string
    public getOperandCount(): int
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__ArgV&nbsp;::&nbsp;\_\_construct__](util-ArgV-__construct.md) |  |
| [__ArgV&nbsp;::&nbsp;getScriptName__](util-ArgV-getScriptName.md) | Get the name of the file that was executed |
| [__ArgV&nbsp;::&nbsp;getScriptPath__](util-ArgV-getScriptPath.md) | Get the absolut path to the file that was executed |
| [__ArgV&nbsp;::&nbsp;getFlags__](util-ArgV-getFlags.md) | Get all the flags that was passed |
| [__ArgV&nbsp;::&nbsp;hasFlag__](util-ArgV-hasFlag.md) | Check to see if a specific flag was passed  A flag is one that was passed as `-f` |
| [__ArgV&nbsp;::&nbsp;getOptions__](util-ArgV-getOptions.md) | Get all of the options that was passed |
| [__ArgV&nbsp;::&nbsp;hasOption__](util-ArgV-hasOption.md) | Check to see if an option is available |
| [__ArgV&nbsp;::&nbsp;getOption__](util-ArgV-getOption.md) | Get the value from an option |
| [__ArgV&nbsp;::&nbsp;getOptionAsList__](util-ArgV-getOptionAsList.md) | Get values from an option as a list  This will always return a list of values, even if there is only one value or none at all |
| [__ArgV&nbsp;::&nbsp;getOperands__](util-ArgV-getOperands.md) | Get a list of all of the operands |
| [__ArgV&nbsp;::&nbsp;getOperand__](util-ArgV-getOperand.md) | Get a specific operand by it's position relative to all passed operands |
| [__ArgV&nbsp;::&nbsp;getOperandCount__](util-ArgV-getOperandCount.md) | Get the number of operands |

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
