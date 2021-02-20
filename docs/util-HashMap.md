# [Base](base.md) / [Utilities](util.md) / HashMap
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
class HashMap extends im\util\Map implements im\util\MapArray, IteratorAggregate, Traversable, im\util\Collection {

    // Methods
    public addIterable(iterable $list): void
    public get(mixed $key, mixed $defVal = NULL): mixed
    public set(mixed $key, mixed $value): void
    public unset(mixed $key): mixed
    public isset(mixed $key): bool
    public toArray(): array
    public equals(object $other): bool

    // Inherited Methods
    public __construct(null|iterable $values = NULL)
    public remove(mixed $value): void
    public find(mixed $value): mixed
    public contains(mixed $value): bool
    public getValues(): im\util\IndexArray
    public getKeys(): im\util\IndexArray
    public static combineArrays(array &$array1, array &$array2): array
    public lock(): void
    public clear(): void
    public length(): int
    public copy(null|callable $sort = NULL): static
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__HashMap&nbsp;::&nbsp;addIterable__](util-HashMap-addIterable.md) | Add elements from an iterator |
| [__HashMap&nbsp;::&nbsp;get__](util-HashMap-get.md) | Return a value from within this bundle |
| [__HashMap&nbsp;::&nbsp;set__](util-HashMap-set.md) | Add/Replace a value in this map |
| [__HashMap&nbsp;::&nbsp;unset__](util-HashMap-unset.md) | Remove a value from this map |
| [__HashMap&nbsp;::&nbsp;isset__](util-HashMap-isset.md) | Check if a key has been assigned to this map |
| [__HashMap&nbsp;::&nbsp;toArray__](util-HashMap-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__HashMap&nbsp;::&nbsp;equals__](util-HashMap-equals.md) | Compare an object against this instance |
| [__HashMap&nbsp;::&nbsp;\_\_construct__](util-HashMap-__construct.md) |  |
| [__HashMap&nbsp;::&nbsp;remove__](util-HashMap-remove.md) | Remove a value from all assigned keys within this map  Searches for a specified value and removes all occurrences that it finds |
| [__HashMap&nbsp;::&nbsp;find__](util-HashMap-find.md) | Find the key matching the first location with a specified value |
| [__HashMap&nbsp;::&nbsp;contains__](util-HashMap-contains.md) | Check if a value exists in this map |
| [__HashMap&nbsp;::&nbsp;getValues__](util-HashMap-getValues.md) | Returns an indexed list of all values assigned to this bundle |
| [__HashMap&nbsp;::&nbsp;getKeys__](util-HashMap-getKeys.md) | Returns an indexed list of all keys assigned to this bundle |
| [__HashMap&nbsp;::&nbsp;combineArrays__](util-HashMap-combineArrays.md) | Combine two arrays recursively  This is similar to `array_merge_recursive()`, but this method does not alter the structure |
| [__HashMap&nbsp;::&nbsp;lock__](util-HashMap-lock.md) | Lock the dataset to make it immutable |
| [__HashMap&nbsp;::&nbsp;clear__](util-HashMap-clear.md) | Clear the collection |
| [__HashMap&nbsp;::&nbsp;length__](util-HashMap-length.md) | Get the current length of the collection |
| [__HashMap&nbsp;::&nbsp;copy__](util-HashMap-copy.md) | Clone this instance and return it |
