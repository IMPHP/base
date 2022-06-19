# [Base](base.md) / [Utilities](util.md) / Stackable
 > im\util\Stackable
____

## Description
Defines a basic stackable class.

The order of in/out is not defined in this class,
and is decided by the class extending this. This class only
defines the basic methods for any stackable class and a few
pre-build collection methods. Whether an implementation uses
FILO, FIFO or something else entirely, is up to each implementation.

## Synopsis
```php
abstract class Stackable extends im\util\BaseCollection implements IteratorAggregate, im\features\Serializable, im\features\Cloneable, Traversable, im\util\Collection {

    // Methods
    public __construct()
    public clear(): void
    public length(): int
    public toArray(): array
    abstract public push(mixed $value): void
    abstract public pop(): mixed
    abstract public peak(): mixed
    public get(): mixed
    public equals(object $other): bool
    public traverse(callable $func): bool
    public copy(null|callable $sort = NULL): static

    // Inherited Methods
    public static combineArrays(array &$array1, array &$array2): array
    public lock(): void
    public clone(): static
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__Stackable&nbsp;::&nbsp;\_\_construct__](util-Stackable-__construct.md) |  |
| [__Stackable&nbsp;::&nbsp;clear__](util-Stackable-clear.md) |  |
| [__Stackable&nbsp;::&nbsp;length__](util-Stackable-length.md) | Get the current length of the collection |
| [__Stackable&nbsp;::&nbsp;toArray__](util-Stackable-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__Stackable&nbsp;::&nbsp;push__](util-Stackable-push.md) | Push a new value into this stackable instance |
| [__Stackable&nbsp;::&nbsp;pop__](util-Stackable-pop.md) | Pop a value off of this stackable instance |
| [__Stackable&nbsp;::&nbsp;peak__](util-Stackable-peak.md) | Returns the current value in the stack |
| [__~Stackable&nbsp;::&nbsp;get~__](util-Stackable-get.md) | Returns the current value in the stack |
| [__Stackable&nbsp;::&nbsp;equals__](util-Stackable-equals.md) | Compare an object against this instance |
| [__Stackable&nbsp;::&nbsp;traverse__](util-Stackable-traverse.md) | Traverses the dataset |
| [__~Stackable&nbsp;::&nbsp;copy~__](util-Stackable-copy.md) | Clone this instance and return it |
| [__Stackable&nbsp;::&nbsp;combineArrays__](util-Stackable-combineArrays.md) | Combine two arrays recursively  This is similar to `array_merge_recursive()`, but this method does not alter the structure |
| [__~Stackable&nbsp;::&nbsp;lock~__](util-Stackable-lock.md) | Lock the dataset to make it immutable |
| [__Stackable&nbsp;::&nbsp;clone__](util-Stackable-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
