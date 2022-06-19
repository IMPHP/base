# [Base](base.md) / [Utilities](util.md) / LIFOStack
 > im\util\LIFOStack
____

## Description
A LIFO Stack implementation

## Synopsis
```php
class LIFOStack extends im\util\Stackable implements im\util\Collection, Traversable, im\features\Cloneable, im\features\Serializable, IteratorAggregate {

    // Methods
    public push(mixed $value): void
    public pop(): mixed
    public peak(): mixed

    // Inherited Methods
    public __construct()
    public clear(): void
    public length(): int
    public toArray(): array
    public get(): mixed
    public equals(object $other): bool
    public traverse(callable $func): bool
    public copy(null|callable $sort = NULL): static
    public static combineArrays(array &$array1, array &$array2): array
    public lock(): void
    public clone(): static
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__LIFOStack&nbsp;::&nbsp;push__](util-LIFOStack-push.md) | Push a new value into this stackable instance |
| [__LIFOStack&nbsp;::&nbsp;pop__](util-LIFOStack-pop.md) | Pop a value off of this stackable instance |
| [__LIFOStack&nbsp;::&nbsp;peak__](util-LIFOStack-peak.md) | Returns the current value in the stack |
| [__LIFOStack&nbsp;::&nbsp;\_\_construct__](util-LIFOStack-__construct.md) |  |
| [__LIFOStack&nbsp;::&nbsp;clear__](util-LIFOStack-clear.md) |  |
| [__LIFOStack&nbsp;::&nbsp;length__](util-LIFOStack-length.md) | Get the current length of the collection |
| [__LIFOStack&nbsp;::&nbsp;toArray__](util-LIFOStack-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__~LIFOStack&nbsp;::&nbsp;get~__](util-LIFOStack-get.md) | Returns the current value in the stack |
| [__LIFOStack&nbsp;::&nbsp;equals__](util-LIFOStack-equals.md) | Compare an object against this instance |
| [__LIFOStack&nbsp;::&nbsp;traverse__](util-LIFOStack-traverse.md) | Traverses the dataset |
| [__~LIFOStack&nbsp;::&nbsp;copy~__](util-LIFOStack-copy.md) | Clone this instance and return it |
| [__LIFOStack&nbsp;::&nbsp;combineArrays__](util-LIFOStack-combineArrays.md) | Combine two arrays recursively  This is similar to `array_merge_recursive()`, but this method does not alter the structure |
| [__~LIFOStack&nbsp;::&nbsp;lock~__](util-LIFOStack-lock.md) | Lock the dataset to make it immutable |
| [__LIFOStack&nbsp;::&nbsp;clone__](util-LIFOStack-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
