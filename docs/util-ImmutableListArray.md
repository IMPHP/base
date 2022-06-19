# [Base](base.md) / [Utilities](util.md) / ImmutableListArray
 > im\util\ImmutableListArray
____

## Description
Defines an unmodifiable unstructured list

## Synopsis
```php
interface ImmutableListArray implements im\util\Collection, Traversable, im\features\Cloneable, im\features\Serializable, IteratorAggregate {

    // Methods
    join(null|string $delimiter = NULL): string
    contains(mixed $value): bool
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
| [__ImmutableListArray&nbsp;::&nbsp;join__](util-ImmutableListArray-join.md) | Join all the values in the list into one string |
| [__ImmutableListArray&nbsp;::&nbsp;contains__](util-ImmutableListArray-contains.md) | Checks to see if a value exists in this list |
| [__ImmutableListArray&nbsp;::&nbsp;filter__](util-ImmutableListArray-filter.md) | Filters elements of the collection |
| [__ImmutableListArray&nbsp;::&nbsp;length__](util-ImmutableListArray-length.md) | Get the current length of the collection |
| [__ImmutableListArray&nbsp;::&nbsp;toArray__](util-ImmutableListArray-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__~ImmutableListArray&nbsp;::&nbsp;copy~__](util-ImmutableListArray-copy.md) | Clone this instance and return it |
| [__ImmutableListArray&nbsp;::&nbsp;equals__](util-ImmutableListArray-equals.md) | Compare an object against this instance |
| [__ImmutableListArray&nbsp;::&nbsp;traverse__](util-ImmutableListArray-traverse.md) | Traverses the dataset |
| [__ImmutableListArray&nbsp;::&nbsp;getIterator__](util-ImmutableListArray-getIterator.md) |  |
| [__ImmutableListArray&nbsp;::&nbsp;\_\_serialize__](util-ImmutableListArray-__serialize.md) |  |
| [__ImmutableListArray&nbsp;::&nbsp;\_\_unserialize__](util-ImmutableListArray-__unserialize.md) |  |
| [__ImmutableListArray&nbsp;::&nbsp;\_\_debugInfo__](util-ImmutableListArray-__debugInfo.md) |  |
| [__ImmutableListArray&nbsp;::&nbsp;clone__](util-ImmutableListArray-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
