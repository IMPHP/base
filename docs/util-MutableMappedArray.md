# [Base](base.md) / [Utilities](util.md) / MutableMappedArray
 > im\util\MutableMappedArray
____

## Description
Defines a modifiable map

## Synopsis
```php
interface MutableMappedArray implements im\util\ImmutableMappedArray, IteratorAggregate, im\features\Serializable, im\features\Cloneable, Traversable, im\util\Collection {

    // Methods
    addIterable(iterable $list): void
    remove(mixed $value): int

    // Inherited Methods
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
| [__MutableMappedArray&nbsp;::&nbsp;addIterable__](util-MutableMappedArray-addIterable.md) | Add elements from an iterator |
| [__MutableMappedArray&nbsp;::&nbsp;remove__](util-MutableMappedArray-remove.md) | Remove a value from all assigned keys within this map  Searches for a specified value and removes all occurrences that it finds |
| [__MutableMappedArray&nbsp;::&nbsp;contains__](util-MutableMappedArray-contains.md) | Check if a value exists in this map |
| [__MutableMappedArray&nbsp;::&nbsp;getValues__](util-MutableMappedArray-getValues.md) | Returns a list of all values assigned to this map |
| [__MutableMappedArray&nbsp;::&nbsp;getKeys__](util-MutableMappedArray-getKeys.md) | Returns a list of all keys assigned to this map |
| [__MutableMappedArray&nbsp;::&nbsp;filter__](util-MutableMappedArray-filter.md) | Filters elements of the collection |
| [__MutableMappedArray&nbsp;::&nbsp;length__](util-MutableMappedArray-length.md) | Get the current length of the collection |
| [__MutableMappedArray&nbsp;::&nbsp;toArray__](util-MutableMappedArray-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__~MutableMappedArray&nbsp;::&nbsp;copy~__](util-MutableMappedArray-copy.md) | Clone this instance and return it |
| [__MutableMappedArray&nbsp;::&nbsp;equals__](util-MutableMappedArray-equals.md) | Compare an object against this instance |
| [__MutableMappedArray&nbsp;::&nbsp;traverse__](util-MutableMappedArray-traverse.md) | Traverses the dataset |
| [__MutableMappedArray&nbsp;::&nbsp;getIterator__](util-MutableMappedArray-getIterator.md) |  |
| [__MutableMappedArray&nbsp;::&nbsp;\_\_serialize__](util-MutableMappedArray-__serialize.md) |  |
| [__MutableMappedArray&nbsp;::&nbsp;\_\_unserialize__](util-MutableMappedArray-__unserialize.md) |  |
| [__MutableMappedArray&nbsp;::&nbsp;\_\_debugInfo__](util-MutableMappedArray-__debugInfo.md) |  |
| [__MutableMappedArray&nbsp;::&nbsp;clone__](util-MutableMappedArray-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
