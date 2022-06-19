# [Base](base.md) / [Utilities](util.md) / BaseCollection
 > im\util\BaseCollection
____

## Description
An abstract implementation of the `Collection` interface.

## Synopsis
```php
abstract class BaseCollection implements im\util\Collection, Traversable, im\features\Cloneable, im\features\Serializable, IteratorAggregate {

    // Methods
    public static combineArrays(array &$array1, array &$array2): array
    public toArray(): array
    public lock(): void
    public traverse(callable $func): bool
    public clone(): static

    // Inherited Methods
    abstract public length(): int
    abstract public copy(null|callable $sort = NULL): static
    abstract public equals(object $other): bool
    abstract public getIterator()
    abstract public __unserialize(array $data): void
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__BaseCollection&nbsp;::&nbsp;combineArrays__](util-BaseCollection-combineArrays.md) | Combine two arrays recursively  This is similar to `array_merge_recursive()`, but this method does not alter the structure |
| [__BaseCollection&nbsp;::&nbsp;toArray__](util-BaseCollection-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__~BaseCollection&nbsp;::&nbsp;lock~__](util-BaseCollection-lock.md) | Lock the dataset to make it immutable |
| [__BaseCollection&nbsp;::&nbsp;traverse__](util-BaseCollection-traverse.md) | Traverses the dataset |
| [__BaseCollection&nbsp;::&nbsp;clone__](util-BaseCollection-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
| [__BaseCollection&nbsp;::&nbsp;length__](util-BaseCollection-length.md) | Get the current length of the collection |
| [__~BaseCollection&nbsp;::&nbsp;copy~__](util-BaseCollection-copy.md) | Clone this instance and return it |
| [__BaseCollection&nbsp;::&nbsp;equals__](util-BaseCollection-equals.md) | Compare an object against this instance |
| [__BaseCollection&nbsp;::&nbsp;getIterator__](util-BaseCollection-getIterator.md) |  |
| [__BaseCollection&nbsp;::&nbsp;\_\_unserialize__](util-BaseCollection-__unserialize.md) |  |
