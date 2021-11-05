# [Base](base.md) / [Utilities](util.md) / Stack
 > im\util\Stack
____

## Description
This stack-able pushes values to the top while
also popping them from the top.

> :warning: **Deprecated**  
> This class has been replaced by `im\util\LIFOStack`  

 > This is just a reference class that extends `im\util\LIFOStack`  

## Synopsis
```php
class Stack extends im\util\LIFOStack implements IteratorAggregate, Traversable, im\util\Collection {

    // Inherited Properties
    protected array $dataset = Array

    // Inherited Methods
    public push(mixed $value): void
    public pop(): mixed
    public peak(): mixed
    public get(): mixed
    public equals(object $other): bool
    public traverse(callable $func): bool
    public copy(null|callable $sort = NULL): static
    public static combineArrays(array &$array1, array &$array2): array
    public __construct()
    public lock(): void
    public clear(): void
    public length(): int
    public toArray(): array
}
```

## Properties
| Name | Description |
| :--- | :---------- |
| [__Stack&nbsp;::&nbsp;$dataset__](util-Stack-var_dataset.md) | Internal property containing the dataset for the collection |

## Methods
| Name | Description |
| :--- | :---------- |
| [__Stack&nbsp;::&nbsp;push__](util-Stack-push.md) | Push a new value into this stackable instance |
| [__Stack&nbsp;::&nbsp;pop__](util-Stack-pop.md) | Pop a value off of this stackable instance |
| [__Stack&nbsp;::&nbsp;peak__](util-Stack-peak.md) | Returns the current value in the stack |
| [__~Stack&nbsp;::&nbsp;get~__](util-Stack-get.md) | Returns the current value in the stack |
| [__Stack&nbsp;::&nbsp;equals__](util-Stack-equals.md) | Compare an object against this instance |
| [__Stack&nbsp;::&nbsp;traverse__](util-Stack-traverse.md) | Traverses the dataset |
| [__Stack&nbsp;::&nbsp;copy__](util-Stack-copy.md) | Clone this instance and return it |
| [__Stack&nbsp;::&nbsp;combineArrays__](util-Stack-combineArrays.md) | Combine two arrays recursively  This is similar to `array_merge_recursive()`, but this method does not alter the structure |
| [__Stack&nbsp;::&nbsp;\_\_construct__](util-Stack-__construct.md) |  |
| [__~Stack&nbsp;::&nbsp;lock~__](util-Stack-lock.md) | Lock the dataset to make it immutable |
| [__Stack&nbsp;::&nbsp;clear__](util-Stack-clear.md) | Clear the collection |
| [__Stack&nbsp;::&nbsp;length__](util-Stack-length.md) | Get the current length of the collection |
| [__Stack&nbsp;::&nbsp;toArray__](util-Stack-toArray.md) | Builds a PHP array containing all of the current values within the collection |
