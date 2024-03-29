# [Base](base.md) / [Utilities](util.md) / ImmutableStructuredList
 > im\util\ImmutableStructuredList
____

## Description
Defines an unmodifiable structured list

## Synopsis
```php
interface ImmutableStructuredList implements im\util\ImmutableListArray, IteratorAggregate, im\features\Serializable, im\features\Cloneable, Traversable, im\util\Collection {

    // Methods
    indexOf(mixed $value): int
    get(int $key, mixed $defVal = NULL): mixed

    // Inherited Methods
    join(null|string $delimiter = NULL): string
    contains(mixed $value): bool
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
| [__ImmutableStructuredList&nbsp;::&nbsp;indexOf__](util-ImmutableStructuredList-indexOf.md) | Returns the positional key for a given value  The key that is returned is for the first occurance of the specified value |
| [__ImmutableStructuredList&nbsp;::&nbsp;get__](util-ImmutableStructuredList-get.md) | Returns the value for a positional key |
| [__ImmutableStructuredList&nbsp;::&nbsp;join__](util-ImmutableStructuredList-join.md) | Join all the values in the list into one string |
| [__ImmutableStructuredList&nbsp;::&nbsp;contains__](util-ImmutableStructuredList-contains.md) | Checks to see if a value exists in this list |
| [__ImmutableStructuredList&nbsp;::&nbsp;filter__](util-ImmutableStructuredList-filter.md) | Filters elements of the collection |
| [__ImmutableStructuredList&nbsp;::&nbsp;length__](util-ImmutableStructuredList-length.md) | Get the current length of the collection |
| [__ImmutableStructuredList&nbsp;::&nbsp;toArray__](util-ImmutableStructuredList-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__~ImmutableStructuredList&nbsp;::&nbsp;copy~__](util-ImmutableStructuredList-copy.md) | Clone this instance and return it |
| [__ImmutableStructuredList&nbsp;::&nbsp;equals__](util-ImmutableStructuredList-equals.md) | Compare an object against this instance |
| [__ImmutableStructuredList&nbsp;::&nbsp;traverse__](util-ImmutableStructuredList-traverse.md) | Traverses the dataset |
| [__ImmutableStructuredList&nbsp;::&nbsp;getIterator__](util-ImmutableStructuredList-getIterator.md) |  |
| [__ImmutableStructuredList&nbsp;::&nbsp;\_\_serialize__](util-ImmutableStructuredList-__serialize.md) |  |
| [__ImmutableStructuredList&nbsp;::&nbsp;\_\_unserialize__](util-ImmutableStructuredList-__unserialize.md) |  |
| [__ImmutableStructuredList&nbsp;::&nbsp;\_\_debugInfo__](util-ImmutableStructuredList-__debugInfo.md) |  |
| [__ImmutableStructuredList&nbsp;::&nbsp;clone__](util-ImmutableStructuredList-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
