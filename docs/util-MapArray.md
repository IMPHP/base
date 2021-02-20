# [Base](base.md) / [Utilities](util.md) / MapArray
 > im\util\MapArray
____

## Description
Defines an interface for a mapped array.

A mapped array is a list that uses keys to structure it's data.
Each value within a map has a key that points to it and can be used
to access it.

## Synopsis
```php
interface MapArray implements im\util\Collection, Traversable, IteratorAggregate {

    // Methods
    addIterable(iterable $list): void
    get(string $key, mixed $defVal = NULL): mixed
    set(string $key, mixed $value): void
    unset(string $key): mixed
    isset(string $key): bool
    remove(mixed $value): void
    contains(mixed $value): bool
    find(mixed $value): mixed
    getValues(): im\util\IndexArray
    getKeys(): im\util\IndexArray

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
| [__MapArray&nbsp;::&nbsp;addIterable__](util-MapArray-addIterable.md) | Add elements from an iterator |
| [__MapArray&nbsp;::&nbsp;get__](util-MapArray-get.md) | Return a value from within this bundle |
| [__MapArray&nbsp;::&nbsp;set__](util-MapArray-set.md) | Add/Replace a value in this map |
| [__MapArray&nbsp;::&nbsp;unset__](util-MapArray-unset.md) | Remove a value from this map |
| [__MapArray&nbsp;::&nbsp;isset__](util-MapArray-isset.md) | Check if a key has been assigned to this map |
| [__MapArray&nbsp;::&nbsp;remove__](util-MapArray-remove.md) | Remove a value from all assigned keys within this map  Searches for a specified value and removes all occurrences that it finds |
| [__MapArray&nbsp;::&nbsp;contains__](util-MapArray-contains.md) | Check if a value exists in this map |
| [__MapArray&nbsp;::&nbsp;find__](util-MapArray-find.md) | Find the key matching the first location with a specified value |
| [__MapArray&nbsp;::&nbsp;getValues__](util-MapArray-getValues.md) | Returns an indexed list of all values assigned to this bundle |
| [__MapArray&nbsp;::&nbsp;getKeys__](util-MapArray-getKeys.md) | Returns an indexed list of all keys assigned to this bundle |
| [__MapArray&nbsp;::&nbsp;clear__](util-MapArray-clear.md) | Clear the collection |
| [__MapArray&nbsp;::&nbsp;length__](util-MapArray-length.md) | Get the current length of the collection |
| [__MapArray&nbsp;::&nbsp;toArray__](util-MapArray-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__MapArray&nbsp;::&nbsp;copy__](util-MapArray-copy.md) | Clone this instance and return it |
| [__MapArray&nbsp;::&nbsp;equals__](util-MapArray-equals.md) | Compare an object against this instance |
| [__MapArray&nbsp;::&nbsp;getIterator__](util-MapArray-getIterator.md) |  |
