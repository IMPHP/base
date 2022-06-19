# [Base](base.md) / [Utilities](util.md) / ImmutableMappedArray
 > im\util\ImmutableMappedArray
____

## Description
Defines an unmodifiable map

## Synopsis
```php
interface ImmutableMappedArray implements im\util\Collection, Traversable, im\features\Cloneable, im\features\Serializable, IteratorAggregate {

    // Methods
    contains(mixed $value): bool
    getValues(): im\util\ListArray
    getKeys(): im\util\ListArray
    filter(callable $filter): static

    // Inherited Methods
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
| [__ImmutableMappedArray&nbsp;::&nbsp;contains__](util-ImmutableMappedArray-contains.md) | Check if a value exists in this map |
| [__ImmutableMappedArray&nbsp;::&nbsp;getValues__](util-ImmutableMappedArray-getValues.md) | Returns a list of all values assigned to this map |
| [__ImmutableMappedArray&nbsp;::&nbsp;getKeys__](util-ImmutableMappedArray-getKeys.md) | Returns a list of all keys assigned to this map |
| [__ImmutableMappedArray&nbsp;::&nbsp;filter__](util-ImmutableMappedArray-filter.md) | Filters elements of the collection |
| [__ImmutableMappedArray&nbsp;::&nbsp;length__](util-ImmutableMappedArray-length.md) | Get the current length of the collection |
| [__ImmutableMappedArray&nbsp;::&nbsp;toArray__](util-ImmutableMappedArray-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__~ImmutableMappedArray&nbsp;::&nbsp;copy~__](util-ImmutableMappedArray-copy.md) | Clone this instance and return it |
| [__ImmutableMappedArray&nbsp;::&nbsp;equals__](util-ImmutableMappedArray-equals.md) | Compare an object against this instance |
| [__ImmutableMappedArray&nbsp;::&nbsp;traverse__](util-ImmutableMappedArray-traverse.md) | Traverses the dataset |
| [__ImmutableMappedArray&nbsp;::&nbsp;getIterator__](util-ImmutableMappedArray-getIterator.md) |  |
| [__ImmutableMappedArray&nbsp;::&nbsp;\_\_serialize__](util-ImmutableMappedArray-__serialize.md) |  |
| [__ImmutableMappedArray&nbsp;::&nbsp;\_\_unserialize__](util-ImmutableMappedArray-__unserialize.md) |  |
| [__ImmutableMappedArray&nbsp;::&nbsp;\_\_debugInfo__](util-ImmutableMappedArray-__debugInfo.md) |  |
| [__ImmutableMappedArray&nbsp;::&nbsp;clone__](util-ImmutableMappedArray-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
