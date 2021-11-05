# [Base](base.md) / [Utilities](util.md) / ImmutableListArray
 > im\util\ImmutableListArray
____

## Description
Defines an unmodifiable unstructured list

## Synopsis
```php
interface ImmutableListArray implements im\util\Collection, Traversable, IteratorAggregate {

    // Methods
    join(null|string $delimiter = NULL): string
    contains(mixed $value): bool

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
| [__ImmutableListArray&nbsp;::&nbsp;join__](util-ImmutableListArray-join.md) | Join all the values in the list into one string |
| [__ImmutableListArray&nbsp;::&nbsp;contains__](util-ImmutableListArray-contains.md) | Checks to see if a value exists in this list |
| [__ImmutableListArray&nbsp;::&nbsp;clear__](util-ImmutableListArray-clear.md) | Clear the collection |
| [__ImmutableListArray&nbsp;::&nbsp;length__](util-ImmutableListArray-length.md) | Get the current length of the collection |
| [__ImmutableListArray&nbsp;::&nbsp;toArray__](util-ImmutableListArray-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__ImmutableListArray&nbsp;::&nbsp;copy__](util-ImmutableListArray-copy.md) | Clone this instance and return it |
| [__ImmutableListArray&nbsp;::&nbsp;equals__](util-ImmutableListArray-equals.md) | Compare an object against this instance |
| [__ImmutableListArray&nbsp;::&nbsp;traverse__](util-ImmutableListArray-traverse.md) | Traverses the dataset |
| [__ImmutableListArray&nbsp;::&nbsp;getIterator__](util-ImmutableListArray-getIterator.md) |  |
