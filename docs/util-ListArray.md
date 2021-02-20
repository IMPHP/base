# [Base](base.md) / [Utilities](util.md) / ListArray
 > im\util\ListArray
____

## Description
Defines an interface for a list array.

A list array is a very basic list that allows you to add content and later iterate through it.
It does not define any specific structure for the contained data and as such it's not
possible to access individual elements.

## Synopsis
```php
interface ListArray implements im\util\Collection, Traversable, IteratorAggregate {

    // Methods
    join(null|string $delimiter = NULL): string
    addIterable(iterable $list): void
    add(mixed $value): void
    remove(mixed $value): void
    contains(mixed $value): bool

    // Inherited Methods
    clear(): void
    length(): int
    toArray(): array
    copy(null|callable $sort = NULL): static
    equals(object $other): bool
    getIterator()
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__ListArray&nbsp;::&nbsp;join__](util-ListArray-join.md) | Join all the values in the list into one string |
| [__ListArray&nbsp;::&nbsp;addIterable__](util-ListArray-addIterable.md) | Add values from an `iterable` object or array |
| [__ListArray&nbsp;::&nbsp;add__](util-ListArray-add.md) | Add a value to this list |
| [__ListArray&nbsp;::&nbsp;remove__](util-ListArray-remove.md) | Remove a value from the list |
| [__ListArray&nbsp;::&nbsp;contains__](util-ListArray-contains.md) | Checks to see if a value exists in this list |
| [__ListArray&nbsp;::&nbsp;clear__](util-ListArray-clear.md) | Clear the collection |
| [__ListArray&nbsp;::&nbsp;length__](util-ListArray-length.md) | Get the current length of the collection |
| [__ListArray&nbsp;::&nbsp;toArray__](util-ListArray-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__ListArray&nbsp;::&nbsp;copy__](util-ListArray-copy.md) | Clone this instance and return it |
| [__ListArray&nbsp;::&nbsp;equals__](util-ListArray-equals.md) | Compare an object against this instance |
| [__ListArray&nbsp;::&nbsp;getIterator__](util-ListArray-getIterator.md) |  |
