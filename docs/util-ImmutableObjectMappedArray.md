# [Base](base.md) / [Utilities](util.md) / ImmutableObjectMappedArray
 > im\util\ImmutableObjectMappedArray
____

## Description
Defines an unmodifiable map using mixed/object keys

## Synopsis
```php
interface ImmutableObjectMappedArray implements im\util\ImmutableMappedArray, IteratorAggregate, Traversable, im\util\Collection {

    // Methods
    get(mixed $key, mixed $defVal = NULL): mixed
    isset(mixed $key): bool
    find(mixed $value): mixed

    // Inherited Methods
    contains(mixed $value): bool
    getValues(): im\util\ListArray
    getKeys(): im\util\ListArray
    clear(): void
    length(): int
    toArray(): array
    copy(null|callable $sort = NULL): static
    equals(object $other): bool
    traverse(callable $func): bool
    getIterator()
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__ImmutableObjectMappedArray&nbsp;::&nbsp;get__](util-ImmutableObjectMappedArray-get.md) | Return a value from within this map |
| [__ImmutableObjectMappedArray&nbsp;::&nbsp;isset__](util-ImmutableObjectMappedArray-isset.md) | Check if a key has been assigned to this map |
| [__ImmutableObjectMappedArray&nbsp;::&nbsp;find__](util-ImmutableObjectMappedArray-find.md) | Find the key matching the first location with a specified value |
| [__ImmutableObjectMappedArray&nbsp;::&nbsp;contains__](util-ImmutableObjectMappedArray-contains.md) | Check if a value exists in this map |
| [__ImmutableObjectMappedArray&nbsp;::&nbsp;getValues__](util-ImmutableObjectMappedArray-getValues.md) | Returns a list of all values assigned to this map |
| [__ImmutableObjectMappedArray&nbsp;::&nbsp;getKeys__](util-ImmutableObjectMappedArray-getKeys.md) | Returns a list of all keys assigned to this map |
| [__ImmutableObjectMappedArray&nbsp;::&nbsp;clear__](util-ImmutableObjectMappedArray-clear.md) | Clear the collection |
| [__ImmutableObjectMappedArray&nbsp;::&nbsp;length__](util-ImmutableObjectMappedArray-length.md) | Get the current length of the collection |
| [__ImmutableObjectMappedArray&nbsp;::&nbsp;toArray__](util-ImmutableObjectMappedArray-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__ImmutableObjectMappedArray&nbsp;::&nbsp;copy__](util-ImmutableObjectMappedArray-copy.md) | Clone this instance and return it |
| [__ImmutableObjectMappedArray&nbsp;::&nbsp;equals__](util-ImmutableObjectMappedArray-equals.md) | Compare an object against this instance |
| [__ImmutableObjectMappedArray&nbsp;::&nbsp;traverse__](util-ImmutableObjectMappedArray-traverse.md) | Traverses the dataset |
| [__ImmutableObjectMappedArray&nbsp;::&nbsp;getIterator__](util-ImmutableObjectMappedArray-getIterator.md) |  |
