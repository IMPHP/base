# [Base](base.md) / [Utilities](util.md) / FIFOStack
 > im\util\FIFOStack
____

## Description
A FIFO Stack (Queue) implementation

## Synopsis
```php
class FIFOStack extends im\util\Stackable implements im\util\Collection, Traversable, im\features\Cloneable, im\features\Serializable, IteratorAggregate {

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
| [__FIFOStack&nbsp;::&nbsp;push__](util-FIFOStack-push.md) | Push a new value into this stackable instance |
| [__FIFOStack&nbsp;::&nbsp;pop__](util-FIFOStack-pop.md) | Pop a value off of this stackable instance |
| [__FIFOStack&nbsp;::&nbsp;peak__](util-FIFOStack-peak.md) | Returns the current value in the stack |
| [__FIFOStack&nbsp;::&nbsp;\_\_construct__](util-FIFOStack-__construct.md) |  |
| [__FIFOStack&nbsp;::&nbsp;clear__](util-FIFOStack-clear.md) |  |
| [__FIFOStack&nbsp;::&nbsp;length__](util-FIFOStack-length.md) | Get the current length of the collection |
| [__FIFOStack&nbsp;::&nbsp;toArray__](util-FIFOStack-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__~FIFOStack&nbsp;::&nbsp;get~__](util-FIFOStack-get.md) | Returns the current value in the stack |
| [__FIFOStack&nbsp;::&nbsp;equals__](util-FIFOStack-equals.md) | Compare an object against this instance |
| [__FIFOStack&nbsp;::&nbsp;traverse__](util-FIFOStack-traverse.md) | Traverses the dataset |
| [__~FIFOStack&nbsp;::&nbsp;copy~__](util-FIFOStack-copy.md) | Clone this instance and return it |
| [__FIFOStack&nbsp;::&nbsp;combineArrays__](util-FIFOStack-combineArrays.md) | Combine two arrays recursively  This is similar to `array_merge_recursive()`, but this method does not alter the structure |
| [__~FIFOStack&nbsp;::&nbsp;lock~__](util-FIFOStack-lock.md) | Lock the dataset to make it immutable |
| [__FIFOStack&nbsp;::&nbsp;clone__](util-FIFOStack-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
