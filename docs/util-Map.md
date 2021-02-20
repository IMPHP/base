# [Base](base.md) / [Utilities](util.md) / Map
 > im\util\Map
____

## Description
An implementation of the `MapArray` interface.

## Synopsis
```php
class Map extends im\util\BaseCollection implements im\util\Collection, Traversable, IteratorAggregate, im\util\MapArray {

    // Methods
    public __construct(null|iterable $values = NULL)
    public addIterable(iterable $list): void
    public get(string $key, mixed $defVal = NULL): mixed
    public set(string $key, mixed $value): void
    public unset(string $key): mixed
    public isset(string $key): bool
    public remove(mixed $value): void
    public find(mixed $value): mixed
    public contains(mixed $value): bool
    public getValues(): im\util\IndexArray
    public getKeys(): im\util\IndexArray
    public equals(object $other): bool

    // Inherited Methods
    public static combineArrays(array &$array1, array &$array2): array
    public lock(): void
    public clear(): void
    public length(): int
    public toArray(): array
    public copy(null|callable $sort = NULL): static
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__Map&nbsp;::&nbsp;\_\_construct__](util-Map-__construct.md) |  |
| [__Map&nbsp;::&nbsp;addIterable__](util-Map-addIterable.md) | Add elements from an iterator |
| [__Map&nbsp;::&nbsp;get__](util-Map-get.md) | Return a value from within this bundle |
| [__Map&nbsp;::&nbsp;set__](util-Map-set.md) | Add/Replace a value in this map |
| [__Map&nbsp;::&nbsp;unset__](util-Map-unset.md) | Remove a value from this map |
| [__Map&nbsp;::&nbsp;isset__](util-Map-isset.md) | Check if a key has been assigned to this map |
| [__Map&nbsp;::&nbsp;remove__](util-Map-remove.md) | Remove a value from all assigned keys within this map  Searches for a specified value and removes all occurrences that it finds |
| [__Map&nbsp;::&nbsp;find__](util-Map-find.md) | Find the key matching the first location with a specified value |
| [__Map&nbsp;::&nbsp;contains__](util-Map-contains.md) | Check if a value exists in this map |
| [__Map&nbsp;::&nbsp;getValues__](util-Map-getValues.md) | Returns an indexed list of all values assigned to this bundle |
| [__Map&nbsp;::&nbsp;getKeys__](util-Map-getKeys.md) | Returns an indexed list of all keys assigned to this bundle |
| [__Map&nbsp;::&nbsp;equals__](util-Map-equals.md) | Compare an object against this instance |
| [__Map&nbsp;::&nbsp;combineArrays__](util-Map-combineArrays.md) | Combine two arrays recursively  This is similar to `array_merge_recursive()`, but this method does not alter the structure |
| [__Map&nbsp;::&nbsp;lock__](util-Map-lock.md) | Lock the dataset to make it immutable |
| [__Map&nbsp;::&nbsp;clear__](util-Map-clear.md) | Clear the collection |
| [__Map&nbsp;::&nbsp;length__](util-Map-length.md) | Get the current length of the collection |
| [__Map&nbsp;::&nbsp;toArray__](util-Map-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__Map&nbsp;::&nbsp;copy__](util-Map-copy.md) | Clone this instance and return it |
