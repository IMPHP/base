# [Base](base.md) / [Utilities](util.md) / MapArray
 > im\util\MapArray
____

## Description
Defines an interface for a mapped array.

A mapped array is a list that uses keys to structure it's data.
Each value within a map has a key that points to it and can be used
to access it.

> :warning: **Deprecated**  
> This interface has been replaced by `im\util\ImmutableMappedArray` and `im\util\MutableMappedArray`.  

## Synopsis
```php
interface MapArray implements im\util\MutableMappedArray, im\util\Collection, Traversable, IteratorAggregate, im\util\ImmutableMappedArray {

    // Inherited Methods
    addIterable(iterable $list): void
    remove(mixed $value): int
    contains(mixed $value): bool
    getValues(): im\util\ListArray
    getKeys(): im\util\ListArray
    clear(): void
    length(): int
    toArray(): array
    copy(null|callable $sort = NULL): static
    equals(object $other): bool
    traverse(callable $func): bool
    getIterator()
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__MapArray&nbsp;::&nbsp;addIterable__](util-MapArray-addIterable.md) | Add elements from an iterator |
| [__MapArray&nbsp;::&nbsp;remove__](util-MapArray-remove.md) | Remove a value from all assigned keys within this map  Searches for a specified value and removes all occurrences that it finds |
| [__MapArray&nbsp;::&nbsp;contains__](util-MapArray-contains.md) | Check if a value exists in this map |
| [__MapArray&nbsp;::&nbsp;getValues__](util-MapArray-getValues.md) | Returns a list of all values assigned to this map |
| [__MapArray&nbsp;::&nbsp;getKeys__](util-MapArray-getKeys.md) | Returns a list of all keys assigned to this map |
| [__MapArray&nbsp;::&nbsp;clear__](util-MapArray-clear.md) | Clear the collection |
| [__MapArray&nbsp;::&nbsp;length__](util-MapArray-length.md) | Get the current length of the collection |
| [__MapArray&nbsp;::&nbsp;toArray__](util-MapArray-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__MapArray&nbsp;::&nbsp;copy__](util-MapArray-copy.md) | Clone this instance and return it |
| [__MapArray&nbsp;::&nbsp;equals__](util-MapArray-equals.md) | Compare an object against this instance |
| [__MapArray&nbsp;::&nbsp;traverse__](util-MapArray-traverse.md) | Traverses the dataset |
| [__MapArray&nbsp;::&nbsp;getIterator__](util-MapArray-getIterator.md) |  |
