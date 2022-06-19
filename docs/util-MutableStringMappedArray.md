# [Base](base.md) / [Utilities](util.md) / MutableStringMappedArray
 > im\util\MutableStringMappedArray
____

## Description
Defines a modifiable map using string keys

## Synopsis
```php
interface MutableStringMappedArray implements im\util\ImmutableStringMappedArray, im\util\MutableMappedArray, im\util\Collection, Traversable, im\features\Cloneable, im\features\Serializable, IteratorAggregate, im\util\ImmutableMappedArray {

    // Methods
    set(string $key, mixed $value): mixed
    unset(string $key): mixed

    // Inherited Methods
    get(string $key, mixed $defVal = NULL): mixed
    isset(string $key): bool
    find(mixed $value): null|string
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
    addIterable(iterable $list): void
    remove(mixed $value): int
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__MutableStringMappedArray&nbsp;::&nbsp;set__](util-MutableStringMappedArray-set.md) | Add/Replace a value in this map |
| [__MutableStringMappedArray&nbsp;::&nbsp;unset__](util-MutableStringMappedArray-unset.md) | Remove a value from this map |
| [__MutableStringMappedArray&nbsp;::&nbsp;get__](util-MutableStringMappedArray-get.md) | Return a value from within this map |
| [__MutableStringMappedArray&nbsp;::&nbsp;isset__](util-MutableStringMappedArray-isset.md) | Check if a key has been assigned to this map |
| [__MutableStringMappedArray&nbsp;::&nbsp;find__](util-MutableStringMappedArray-find.md) | Find the key matching the first location with a specified value |
| [__MutableStringMappedArray&nbsp;::&nbsp;contains__](util-MutableStringMappedArray-contains.md) | Check if a value exists in this map |
| [__MutableStringMappedArray&nbsp;::&nbsp;getValues__](util-MutableStringMappedArray-getValues.md) | Returns a list of all values assigned to this map |
| [__MutableStringMappedArray&nbsp;::&nbsp;getKeys__](util-MutableStringMappedArray-getKeys.md) | Returns a list of all keys assigned to this map |
| [__MutableStringMappedArray&nbsp;::&nbsp;filter__](util-MutableStringMappedArray-filter.md) | Filters elements of the collection |
| [__MutableStringMappedArray&nbsp;::&nbsp;length__](util-MutableStringMappedArray-length.md) | Get the current length of the collection |
| [__MutableStringMappedArray&nbsp;::&nbsp;toArray__](util-MutableStringMappedArray-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__~MutableStringMappedArray&nbsp;::&nbsp;copy~__](util-MutableStringMappedArray-copy.md) | Clone this instance and return it |
| [__MutableStringMappedArray&nbsp;::&nbsp;equals__](util-MutableStringMappedArray-equals.md) | Compare an object against this instance |
| [__MutableStringMappedArray&nbsp;::&nbsp;traverse__](util-MutableStringMappedArray-traverse.md) | Traverses the dataset |
| [__MutableStringMappedArray&nbsp;::&nbsp;getIterator__](util-MutableStringMappedArray-getIterator.md) |  |
| [__MutableStringMappedArray&nbsp;::&nbsp;\_\_serialize__](util-MutableStringMappedArray-__serialize.md) |  |
| [__MutableStringMappedArray&nbsp;::&nbsp;\_\_unserialize__](util-MutableStringMappedArray-__unserialize.md) |  |
| [__MutableStringMappedArray&nbsp;::&nbsp;\_\_debugInfo__](util-MutableStringMappedArray-__debugInfo.md) |  |
| [__MutableStringMappedArray&nbsp;::&nbsp;clone__](util-MutableStringMappedArray-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
| [__MutableStringMappedArray&nbsp;::&nbsp;addIterable__](util-MutableStringMappedArray-addIterable.md) | Add elements from an iterator |
| [__MutableStringMappedArray&nbsp;::&nbsp;remove__](util-MutableStringMappedArray-remove.md) | Remove a value from all assigned keys within this map  Searches for a specified value and removes all occurrences that it finds |
