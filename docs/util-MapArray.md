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
interface MapArray implements im\util\MutableMappedArray, im\util\Collection, Traversable, im\features\Cloneable, im\features\Serializable, IteratorAggregate, im\util\ImmutableMappedArray {

    // Inherited Methods
    addIterable(iterable $list): void
    remove(mixed $value): int
    contains(mixed $value): bool
    getValues(): im\util\ListArray
    getKeys(): im\util\ListArray
    filter(callable $filter): static
    length(): int
    toArray(): array
    copy(null|callable $sort = NULL): static
    equals(object $other): bool
    traverse(callable $func): bool
    getIterator()
    __serialize(): array
    __unserialize(array $data): void
    __debugInfo(): array
    clone(): static
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
| [__MapArray&nbsp;::&nbsp;filter__](util-MapArray-filter.md) | Filters elements of the collection |
| [__MapArray&nbsp;::&nbsp;length__](util-MapArray-length.md) | Get the current length of the collection |
| [__MapArray&nbsp;::&nbsp;toArray__](util-MapArray-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__~MapArray&nbsp;::&nbsp;copy~__](util-MapArray-copy.md) | Clone this instance and return it |
| [__MapArray&nbsp;::&nbsp;equals__](util-MapArray-equals.md) | Compare an object against this instance |
| [__MapArray&nbsp;::&nbsp;traverse__](util-MapArray-traverse.md) | Traverses the dataset |
| [__MapArray&nbsp;::&nbsp;getIterator__](util-MapArray-getIterator.md) |  |
| [__MapArray&nbsp;::&nbsp;\_\_serialize__](util-MapArray-__serialize.md) |  |
| [__MapArray&nbsp;::&nbsp;\_\_unserialize__](util-MapArray-__unserialize.md) |  |
| [__MapArray&nbsp;::&nbsp;\_\_debugInfo__](util-MapArray-__debugInfo.md) |  |
| [__MapArray&nbsp;::&nbsp;clone__](util-MapArray-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
