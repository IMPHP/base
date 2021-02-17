# [Base](Base.md) / [Util](Util.md) / IndexArray
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
interface IndexArray extends im\util\ListArray {

    // Methods
    indexOf(mixed $value): int
    get(int $key, mixed $defVal = null): mixed
    set(int $key, mixed $value): void
    unset(int $key): mixed
    insert(int $key, mixed $value): void
    join(string $delimiter = null): string
    addIterable(iterable $list): void
    add(mixed $value): void
    remove(mixed $value): void
    contains(mixed $value): bool
    clear(): void
    length(): int
    toArray(): array
    copy(callable $sort = null): static
    equals(object $other): bool
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__IndexArray&nbsp;::&nbsp;indexOf__](Util-IndexArray_indexOf.md) | Returns the positional key for a given value |
| [__IndexArray&nbsp;::&nbsp;get__](Util-IndexArray_get.md) | Returns the value for a positional key |
| [__IndexArray&nbsp;::&nbsp;set__](Util-IndexArray_set.md) | Set the value on a positional key |
| [__IndexArray&nbsp;::&nbsp;unset__](Util-IndexArray_unset.md) | Remove the element at a positional key |
| [__IndexArray&nbsp;::&nbsp;insert__](Util-IndexArray_insert.md) | Insert a value into a positional key |
| [__IndexArray&nbsp;::&nbsp;join__](Util-IndexArray_join.md) | Join all the values in the list into one string |
| [__IndexArray&nbsp;::&nbsp;addIterable__](Util-IndexArray_addIterable.md) | Add values from an `iterable` object or array |
| [__IndexArray&nbsp;::&nbsp;add__](Util-IndexArray_add.md) | Add a value to this list |
| [__IndexArray&nbsp;::&nbsp;remove__](Util-IndexArray_remove.md) | Remove a value from the list |
| [__IndexArray&nbsp;::&nbsp;contains__](Util-IndexArray_contains.md) | Checks to see if a value exists in this list |
| [__IndexArray&nbsp;::&nbsp;clear__](Util-IndexArray_clear.md) | Clear the collection. This will remove all data from the |
| [__IndexArray&nbsp;::&nbsp;length__](Util-IndexArray_length.md) | Get the current length of the collection |
| [__IndexArray&nbsp;::&nbsp;toArray__](Util-IndexArray_toArray.md) | Builds a PHP array containing all of the current values within |
| [__IndexArray&nbsp;::&nbsp;copy__](Util-IndexArray_copy.md) | Clone this instance and return it |
| [__IndexArray&nbsp;::&nbsp;equals__](Util-IndexArray_equals.md) | Compare an object against this instance. |
