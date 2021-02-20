# [Base](base.md) / [Utilities](util.md) / IndexArray
 > im\util\IndexArray
____

## Description
Defines an interface for a indexed array.

A indexed array is a list that uses numbered positions to
structure it's data. Each value that is added to the list,
is placed in a numbered order below existing values.
This numbered position can then be used to access that value specifically.

Inlike maps, a numbered position in a indexed list is not fixed.
If a value is added or removed in front of an existing value,
that value along with everything following, will shift either backward or
forward by `1`.

## Synopsis
```php
interface IndexArray implements im\util\ListArray, IteratorAggregate, Traversable, im\util\Collection {

    // Methods
    indexOf(mixed $value): int
    get(int $key, mixed $defVal = NULL): mixed
    set(int $key, mixed $value): void
    unset(int $key): mixed
    insert(int $key, mixed $value): void

    // Inherited Methods
    join(null|string $delimiter = NULL): string
    addIterable(iterable $list): void
    add(mixed $value): void
    remove(mixed $value): void
    contains(mixed $value): bool
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
| [__IndexArray&nbsp;::&nbsp;indexOf__](util-IndexArray-indexOf.md) | Returns the positional key for a given value  The key that is returned is for the first occurance of the specified value |
| [__IndexArray&nbsp;::&nbsp;get__](util-IndexArray-get.md) | Returns the value for a positional key |
| [__IndexArray&nbsp;::&nbsp;set__](util-IndexArray-set.md) | Set the value on a positional key  Unlike `add()`, this will set the value for a specified key, rather than just appending the value to the end |
| [__IndexArray&nbsp;::&nbsp;unset__](util-IndexArray-unset.md) | Remove the element at a positional key |
| [__IndexArray&nbsp;::&nbsp;insert__](util-IndexArray-insert.md) | Insert a value into a positional key  Unlike `set()` this will not override the existing value |
| [__IndexArray&nbsp;::&nbsp;join__](util-IndexArray-join.md) | Join all the values in the list into one string |
| [__IndexArray&nbsp;::&nbsp;addIterable__](util-IndexArray-addIterable.md) | Add values from an `iterable` object or array |
| [__IndexArray&nbsp;::&nbsp;add__](util-IndexArray-add.md) | Add a value to this list |
| [__IndexArray&nbsp;::&nbsp;remove__](util-IndexArray-remove.md) | Remove a value from the list |
| [__IndexArray&nbsp;::&nbsp;contains__](util-IndexArray-contains.md) | Checks to see if a value exists in this list |
| [__IndexArray&nbsp;::&nbsp;clear__](util-IndexArray-clear.md) | Clear the collection |
| [__IndexArray&nbsp;::&nbsp;length__](util-IndexArray-length.md) | Get the current length of the collection |
| [__IndexArray&nbsp;::&nbsp;toArray__](util-IndexArray-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__IndexArray&nbsp;::&nbsp;copy__](util-IndexArray-copy.md) | Clone this instance and return it |
| [__IndexArray&nbsp;::&nbsp;equals__](util-IndexArray-equals.md) | Compare an object against this instance |
| [__IndexArray&nbsp;::&nbsp;getIterator__](util-IndexArray-getIterator.md) |  |
