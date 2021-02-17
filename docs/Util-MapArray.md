# [Base](Base.md) / [Util](Util.md) / MapArray
 > im\util\MapArray
____

## Description
Defines an interface for a mapped array.

A mapped array is a list that uses keys to structure it's data.
Each value within a map has a key that points to it and can be used
to access it.

## Synopsis
```php
interface MapArray extends im\util\Collection {

    // Methods
    addIterable(iterable $list): void
    get(string $key, mixed $defVal = null): mixed
    set(string $key, mixed $value): void
    unset(string $key): mixed
    isset(string $key): bool
    remove(mixed $value): void
    contains(mixed $value): bool
    find(mixed $value): mixed
    getValues(): im\util\IndexArray
    getKeys(): im\util\IndexArray
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
| [__MapArray&nbsp;::&nbsp;addIterable__](Util-MapArray_addIterable.md) | Add elements from an iterator |
| [__MapArray&nbsp;::&nbsp;get__](Util-MapArray_get.md) | Return a value from within this bundle |
| [__MapArray&nbsp;::&nbsp;set__](Util-MapArray_set.md) | Add/Replace a value in this map |
| [__MapArray&nbsp;::&nbsp;unset__](Util-MapArray_unset.md) | Remove a value from this map |
| [__MapArray&nbsp;::&nbsp;isset__](Util-MapArray_isset.md) | Check if a key has been assigned to this map |
| [__MapArray&nbsp;::&nbsp;remove__](Util-MapArray_remove.md) | Remove a value from all assigned keys within this map |
| [__MapArray&nbsp;::&nbsp;contains__](Util-MapArray_contains.md) | Check if a value exists in this map |
| [__MapArray&nbsp;::&nbsp;find__](Util-MapArray_find.md) | Find the key matching the first location with a specified value |
| [__MapArray&nbsp;::&nbsp;getValues__](Util-MapArray_getValues.md) | Returns an indexed list of all values assigned to this bundle |
| [__MapArray&nbsp;::&nbsp;getKeys__](Util-MapArray_getKeys.md) | Returns an indexed list of all keys assigned to this bundle |
| [__MapArray&nbsp;::&nbsp;clear__](Util-MapArray_clear.md) | Clear the collection. This will remove all data from the |
| [__MapArray&nbsp;::&nbsp;length__](Util-MapArray_length.md) | Get the current length of the collection |
| [__MapArray&nbsp;::&nbsp;toArray__](Util-MapArray_toArray.md) | Builds a PHP array containing all of the current values within |
| [__MapArray&nbsp;::&nbsp;copy__](Util-MapArray_copy.md) | Clone this instance and return it |
| [__MapArray&nbsp;::&nbsp;equals__](Util-MapArray_equals.md) | Compare an object against this instance. |
