# [Base](Base.md) / [Util](Util.md) / BaseCollection
 > im\util\BaseCollection
____

## Description
An abstract implementation of the `Collection` interface.

## Synopsis
```php
class BaseCollection implements im\util\Collection {

    // Methods
    static combineArrays(array &$array1, array &$array2): array
    __construct(): mixed
    lock(): void
    clear(): void
    length(): int
    toArray(): array
    copy(callable $sort = null): static
    getIterator(): Traversable
    equals(object $other): bool
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__BaseCollection&nbsp;::&nbsp;combineArrays__](Util-BaseCollection_combineArrays.md) | Combine two arrays recursively |
| [__BaseCollection&nbsp;::&nbsp;\_\_construct__](Util-BaseCollection___construct.md) |  |
| [__BaseCollection&nbsp;::&nbsp;lock__](Util-BaseCollection_lock.md) | Lock the dataset to make it immutable |
| [__BaseCollection&nbsp;::&nbsp;clear__](Util-BaseCollection_clear.md) | Clear the collection. This will remove all data from the |
| [__BaseCollection&nbsp;::&nbsp;length__](Util-BaseCollection_length.md) | Get the current length of the collection |
| [__BaseCollection&nbsp;::&nbsp;toArray__](Util-BaseCollection_toArray.md) | Builds a PHP array containing all of the current values within |
| [__BaseCollection&nbsp;::&nbsp;copy__](Util-BaseCollection_copy.md) | Clone this instance and return it |
| [__BaseCollection&nbsp;::&nbsp;getIterator__](Util-BaseCollection_getIterator.md) |  |
| [__BaseCollection&nbsp;::&nbsp;equals__](Util-BaseCollection_equals.md) | Compare an object against this instance. |
