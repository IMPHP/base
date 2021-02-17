# [Base](Base.md) / [Util](Util.md) / Map
 > im\util\Map
____

## Description
An implementation of the `MapArray` interface.

## Synopsis
```php
class Map extends im\util\BaseCollection implements im\util\MapArray {

    // Methods
    __construct(iterable $values = null): mixed
    addIterable(iterable $list): void
    get(string $key, mixed $defVal = null): mixed
    set(string $key, mixed $value): void
    unset(string $key): mixed
    isset(string $key): bool
    remove(mixed $value): void
    find(mixed $value): mixed
    contains(mixed $value): bool
    getValues(): im\util\IndexArray
    getKeys(): im\util\IndexArray
    equals(object $other): bool
    static combineArrays(array &$array1, array &$array2): array
    lock(): void
    clear(): void
    length(): int
    toArray(): array
    copy(callable $sort = null): static
    getIterator(): Traversable
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__Map&nbsp;::&nbsp;\_\_construct__](Util-Map___construct.md) |  |
| [__Map&nbsp;::&nbsp;addIterable__](Util-Map_addIterable.md) | Add elements from an iterator |
| [__Map&nbsp;::&nbsp;get__](Util-Map_get.md) | Return a value from within this bundle |
| [__Map&nbsp;::&nbsp;set__](Util-Map_set.md) | Add/Replace a value in this map |
| [__Map&nbsp;::&nbsp;unset__](Util-Map_unset.md) | Remove a value from this map |
| [__Map&nbsp;::&nbsp;isset__](Util-Map_isset.md) | Check if a key has been assigned to this map |
| [__Map&nbsp;::&nbsp;remove__](Util-Map_remove.md) | Remove a value from all assigned keys within this map |
| [__Map&nbsp;::&nbsp;find__](Util-Map_find.md) | Find the key matching the first location with a specified value |
| [__Map&nbsp;::&nbsp;contains__](Util-Map_contains.md) | Check if a value exists in this map |
| [__Map&nbsp;::&nbsp;getValues__](Util-Map_getValues.md) | Returns an indexed list of all values assigned to this bundle |
| [__Map&nbsp;::&nbsp;getKeys__](Util-Map_getKeys.md) | Returns an indexed list of all keys assigned to this bundle |
| [__Map&nbsp;::&nbsp;equals__](Util-Map_equals.md) | Compare an object against this instance. |
| [__Map&nbsp;::&nbsp;combineArrays__](Util-Map_combineArrays.md) | Combine two arrays recursively |
| [__Map&nbsp;::&nbsp;lock__](Util-Map_lock.md) | Lock the dataset to make it immutable |
| [__Map&nbsp;::&nbsp;clear__](Util-Map_clear.md) | Clear the collection. This will remove all data from the |
| [__Map&nbsp;::&nbsp;length__](Util-Map_length.md) | Get the current length of the collection |
| [__Map&nbsp;::&nbsp;toArray__](Util-Map_toArray.md) | Builds a PHP array containing all of the current values within |
| [__Map&nbsp;::&nbsp;copy__](Util-Map_copy.md) | Clone this instance and return it |
| [__Map&nbsp;::&nbsp;getIterator__](Util-Map_getIterator.md) |  |
