# [Base](base.md) / [Utilities](util.md) / ImmutableStringMappedArray
 > im\util\ImmutableStringMappedArray
____

## Description
Defines an unmodifiable map using string keys

## Synopsis
```php
interface ImmutableStringMappedArray implements im\util\ImmutableMappedArray, IteratorAggregate, im\features\Serializable, im\features\Cloneable, Traversable, im\util\Collection {

    // Methods
    get(string $key, mixed $defVal = NULL): mixed
    isset(string $key): bool
    find(mixed $value): null|string

    // Inherited Methods
    contains(mixed $value): bool
    getValues(): im\util\ListArray
    getKeys(): im\util\ListArray
    filter(callable $filter): static
    length(): int
    toArray(): array
    copy(null|callable $sort = NULL): static
    equals(object $other): bool
    traverse(callable $func): bool
    getIterator()
    __serialize(): array
    __unserialize(array $data): void
    __debugInfo(): array
    clone(): static
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__ImmutableStringMappedArray&nbsp;::&nbsp;get__](util-ImmutableStringMappedArray-get.md) | Return a value from within this map |
| [__ImmutableStringMappedArray&nbsp;::&nbsp;isset__](util-ImmutableStringMappedArray-isset.md) | Check if a key has been assigned to this map |
| [__ImmutableStringMappedArray&nbsp;::&nbsp;find__](util-ImmutableStringMappedArray-find.md) | Find the key matching the first location with a specified value |
| [__ImmutableStringMappedArray&nbsp;::&nbsp;contains__](util-ImmutableStringMappedArray-contains.md) | Check if a value exists in this map |
| [__ImmutableStringMappedArray&nbsp;::&nbsp;getValues__](util-ImmutableStringMappedArray-getValues.md) | Returns a list of all values assigned to this map |
| [__ImmutableStringMappedArray&nbsp;::&nbsp;getKeys__](util-ImmutableStringMappedArray-getKeys.md) | Returns a list of all keys assigned to this map |
| [__ImmutableStringMappedArray&nbsp;::&nbsp;filter__](util-ImmutableStringMappedArray-filter.md) | Filters elements of the collection |
| [__ImmutableStringMappedArray&nbsp;::&nbsp;length__](util-ImmutableStringMappedArray-length.md) | Get the current length of the collection |
| [__ImmutableStringMappedArray&nbsp;::&nbsp;toArray__](util-ImmutableStringMappedArray-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__~ImmutableStringMappedArray&nbsp;::&nbsp;copy~__](util-ImmutableStringMappedArray-copy.md) | Clone this instance and return it |
| [__ImmutableStringMappedArray&nbsp;::&nbsp;equals__](util-ImmutableStringMappedArray-equals.md) | Compare an object against this instance |
| [__ImmutableStringMappedArray&nbsp;::&nbsp;traverse__](util-ImmutableStringMappedArray-traverse.md) | Traverses the dataset |
| [__ImmutableStringMappedArray&nbsp;::&nbsp;getIterator__](util-ImmutableStringMappedArray-getIterator.md) |  |
| [__ImmutableStringMappedArray&nbsp;::&nbsp;\_\_serialize__](util-ImmutableStringMappedArray-__serialize.md) |  |
| [__ImmutableStringMappedArray&nbsp;::&nbsp;\_\_unserialize__](util-ImmutableStringMappedArray-__unserialize.md) |  |
| [__ImmutableStringMappedArray&nbsp;::&nbsp;\_\_debugInfo__](util-ImmutableStringMappedArray-__debugInfo.md) |  |
| [__ImmutableStringMappedArray&nbsp;::&nbsp;clone__](util-ImmutableStringMappedArray-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
