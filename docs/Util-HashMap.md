# [Base](Base.md) / [Util](Util.md) / HashMap
 > im\util\HashMap
____

## Description
An implementation of the `MapArray` interface.

This class is an extension of the `Map` class that adds
support for keys of multiple datatypes. Normally a map only
supports `string` as a key, however this class extends this by allowing
any type to be used, even an object. 

## Synopsis
```php
class HashMap extends im\util\Map {

    // Methods
    addIterable(iterable $list): void
    get(mixed $key, mixed $defVal = null): mixed
    set(mixed $key, mixed $value): void
    unset(mixed $key): mixed
    isset(mixed $key): bool
    toArray(): array
    equals(object $other): bool
    __construct(iterable $values = null): mixed
    remove(mixed $value): void
    find(mixed $value): mixed
    contains(mixed $value): bool
    getValues(): im\util\IndexArray
    getKeys(): im\util\IndexArray
    static combineArrays(array &$array1, array &$array2): array
    lock(): void
    clear(): void
    length(): int
    copy(callable $sort = null): static
    getIterator(): Traversable
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__HashMap&nbsp;::&nbsp;addIterable__](Util-HashMap_addIterable.md) | Add elements from an iterator |
| [__HashMap&nbsp;::&nbsp;get__](Util-HashMap_get.md) | Return a value from within this bundle |
| [__HashMap&nbsp;::&nbsp;set__](Util-HashMap_set.md) | Add/Replace a value in this map |
| [__HashMap&nbsp;::&nbsp;unset__](Util-HashMap_unset.md) | Remove a value from this map |
| [__HashMap&nbsp;::&nbsp;isset__](Util-HashMap_isset.md) | Check if a key has been assigned to this map |
| [__HashMap&nbsp;::&nbsp;toArray__](Util-HashMap_toArray.md) | Builds a PHP array containing all of the current values within |
| [__HashMap&nbsp;::&nbsp;equals__](Util-HashMap_equals.md) | Compare an object against this instance. |
| [__HashMap&nbsp;::&nbsp;\_\_construct__](Util-HashMap___construct.md) |  |
| [__HashMap&nbsp;::&nbsp;remove__](Util-HashMap_remove.md) | Remove a value from all assigned keys within this map |
| [__HashMap&nbsp;::&nbsp;find__](Util-HashMap_find.md) | Find the key matching the first location with a specified value |
| [__HashMap&nbsp;::&nbsp;contains__](Util-HashMap_contains.md) | Check if a value exists in this map |
| [__HashMap&nbsp;::&nbsp;getValues__](Util-HashMap_getValues.md) | Returns an indexed list of all values assigned to this bundle |
| [__HashMap&nbsp;::&nbsp;getKeys__](Util-HashMap_getKeys.md) | Returns an indexed list of all keys assigned to this bundle |
| [__HashMap&nbsp;::&nbsp;combineArrays__](Util-HashMap_combineArrays.md) | Combine two arrays recursively |
| [__HashMap&nbsp;::&nbsp;lock__](Util-HashMap_lock.md) | Lock the dataset to make it immutable |
| [__HashMap&nbsp;::&nbsp;clear__](Util-HashMap_clear.md) | Clear the collection. This will remove all data from the |
| [__HashMap&nbsp;::&nbsp;length__](Util-HashMap_length.md) | Get the current length of the collection |
| [__HashMap&nbsp;::&nbsp;copy__](Util-HashMap_copy.md) | Clone this instance and return it |
| [__HashMap&nbsp;::&nbsp;getIterator__](Util-HashMap_getIterator.md) |  |
