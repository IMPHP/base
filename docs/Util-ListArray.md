# [Base](Base.md) / [Util](Util.md) / ListArray
 > im\util\ListArray
____

## Description
Defines an interface for a list array.

A list array is a very basic list that allows you to add content and later iterate through it.
It does not define any specific structure for the contained data and as such it's not
possible to access individual elements.

## Synopsis
```php
interface ListArray extends im\util\Collection {

    // Methods
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
| [__ListArray&nbsp;::&nbsp;join__](Util-ListArray_join.md) | Join all the values in the list into one string |
| [__ListArray&nbsp;::&nbsp;addIterable__](Util-ListArray_addIterable.md) | Add values from an `iterable` object or array |
| [__ListArray&nbsp;::&nbsp;add__](Util-ListArray_add.md) | Add a value to this list |
| [__ListArray&nbsp;::&nbsp;remove__](Util-ListArray_remove.md) | Remove a value from the list |
| [__ListArray&nbsp;::&nbsp;contains__](Util-ListArray_contains.md) | Checks to see if a value exists in this list |
| [__ListArray&nbsp;::&nbsp;clear__](Util-ListArray_clear.md) | Clear the collection. This will remove all data from the |
| [__ListArray&nbsp;::&nbsp;length__](Util-ListArray_length.md) | Get the current length of the collection |
| [__ListArray&nbsp;::&nbsp;toArray__](Util-ListArray_toArray.md) | Builds a PHP array containing all of the current values within |
| [__ListArray&nbsp;::&nbsp;copy__](Util-ListArray_copy.md) | Clone this instance and return it |
| [__ListArray&nbsp;::&nbsp;equals__](Util-ListArray_equals.md) | Compare an object against this instance. |
