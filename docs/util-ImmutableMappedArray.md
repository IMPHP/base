# [Base](base.md) / [Utilities](util.md) / ImmutableMappedArray
 > im\util\ImmutableMappedArray
____

## Description
Defines an unmodifiable map

## Synopsis
```php
interface ImmutableMappedArray implements im\util\Collection, Traversable, IteratorAggregate {

    // Methods
    contains(mixed $value): bool
    getValues(): im\util\ListArray
    getKeys(): im\util\ListArray

    // Inherited Methods
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
| [__ImmutableMappedArray&nbsp;::&nbsp;contains__](util-ImmutableMappedArray-contains.md) | Check if a value exists in this map |
| [__ImmutableMappedArray&nbsp;::&nbsp;getValues__](util-ImmutableMappedArray-getValues.md) | Returns a list of all values assigned to this map |
| [__ImmutableMappedArray&nbsp;::&nbsp;getKeys__](util-ImmutableMappedArray-getKeys.md) | Returns a list of all keys assigned to this map |
| [__ImmutableMappedArray&nbsp;::&nbsp;clear__](util-ImmutableMappedArray-clear.md) | Clear the collection |
| [__ImmutableMappedArray&nbsp;::&nbsp;length__](util-ImmutableMappedArray-length.md) | Get the current length of the collection |
| [__ImmutableMappedArray&nbsp;::&nbsp;toArray__](util-ImmutableMappedArray-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__ImmutableMappedArray&nbsp;::&nbsp;copy__](util-ImmutableMappedArray-copy.md) | Clone this instance and return it |
| [__ImmutableMappedArray&nbsp;::&nbsp;equals__](util-ImmutableMappedArray-equals.md) | Compare an object against this instance |
| [__ImmutableMappedArray&nbsp;::&nbsp;traverse__](util-ImmutableMappedArray-traverse.md) | Traverses the dataset |
| [__ImmutableMappedArray&nbsp;::&nbsp;getIterator__](util-ImmutableMappedArray-getIterator.md) |  |
