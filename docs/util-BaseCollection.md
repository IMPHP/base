# [Base](base.md) / [Utilities](util.md) / BaseCollection
 > im\util\BaseCollection
____

## Description
An abstract implementation of the `Collection` interface.

## Synopsis
```php
abstract class BaseCollection implements im\util\Collection, Traversable, IteratorAggregate {

    // Methods
    public static combineArrays(array &$array1, array &$array2): array
    public __construct()
    public lock(): void
    public clear(): void
    public length(): int
    public toArray(): array
    public copy(null|callable $sort = NULL): static

    // Inherited Methods
    abstract public equals(object $other): bool
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__BaseCollection&nbsp;::&nbsp;combineArrays__](util-BaseCollection-combineArrays.md) | Combine two arrays recursively  This is similar to `array_merge_recursive()`, but this method does not alter the structure |
| [__BaseCollection&nbsp;::&nbsp;\_\_construct__](util-BaseCollection-__construct.md) |  |
| [__BaseCollection&nbsp;::&nbsp;lock__](util-BaseCollection-lock.md) | Lock the dataset to make it immutable |
| [__BaseCollection&nbsp;::&nbsp;clear__](util-BaseCollection-clear.md) | Clear the collection |
| [__BaseCollection&nbsp;::&nbsp;length__](util-BaseCollection-length.md) | Get the current length of the collection |
| [__BaseCollection&nbsp;::&nbsp;toArray__](util-BaseCollection-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__BaseCollection&nbsp;::&nbsp;copy__](util-BaseCollection-copy.md) | Clone this instance and return it |
| [__BaseCollection&nbsp;::&nbsp;equals__](util-BaseCollection-equals.md) | Compare an object against this instance |
