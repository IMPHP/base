# [Base](base.md) / [Utilities](util.md) / MutableObjectMappedArray
 > im\util\MutableObjectMappedArray
____

## Description
Defines a modifiable map using mixed/object keys

## Synopsis
```php
interface MutableObjectMappedArray implements im\util\ImmutableObjectMappedArray, im\util\MutableMappedArray, im\util\Collection, Traversable, im\features\Cloneable, im\features\Serializable, IteratorAggregate, im\util\ImmutableMappedArray {

    // Methods
    set(mixed $key, mixed $value): mixed
    unset(mixed $key): mixed

    // Inherited Methods
    get(mixed $key, mixed $defVal = NULL): mixed
    isset(mixed $key): bool
    find(mixed $value): mixed
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
| [__MutableObjectMappedArray&nbsp;::&nbsp;set__](util-MutableObjectMappedArray-set.md) | Add/Replace a value in this map |
| [__MutableObjectMappedArray&nbsp;::&nbsp;unset__](util-MutableObjectMappedArray-unset.md) | Remove a value from this map |
| [__MutableObjectMappedArray&nbsp;::&nbsp;get__](util-MutableObjectMappedArray-get.md) | Return a value from within this map |
| [__MutableObjectMappedArray&nbsp;::&nbsp;isset__](util-MutableObjectMappedArray-isset.md) | Check if a key has been assigned to this map |
| [__MutableObjectMappedArray&nbsp;::&nbsp;find__](util-MutableObjectMappedArray-find.md) | Find the key matching the first location with a specified value |
| [__MutableObjectMappedArray&nbsp;::&nbsp;contains__](util-MutableObjectMappedArray-contains.md) | Check if a value exists in this map |
| [__MutableObjectMappedArray&nbsp;::&nbsp;getValues__](util-MutableObjectMappedArray-getValues.md) | Returns a list of all values assigned to this map |
| [__MutableObjectMappedArray&nbsp;::&nbsp;getKeys__](util-MutableObjectMappedArray-getKeys.md) | Returns a list of all keys assigned to this map |
| [__MutableObjectMappedArray&nbsp;::&nbsp;filter__](util-MutableObjectMappedArray-filter.md) | Filters elements of the collection |
| [__MutableObjectMappedArray&nbsp;::&nbsp;length__](util-MutableObjectMappedArray-length.md) | Get the current length of the collection |
| [__MutableObjectMappedArray&nbsp;::&nbsp;toArray__](util-MutableObjectMappedArray-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__~MutableObjectMappedArray&nbsp;::&nbsp;copy~__](util-MutableObjectMappedArray-copy.md) | Clone this instance and return it |
| [__MutableObjectMappedArray&nbsp;::&nbsp;equals__](util-MutableObjectMappedArray-equals.md) | Compare an object against this instance |
| [__MutableObjectMappedArray&nbsp;::&nbsp;traverse__](util-MutableObjectMappedArray-traverse.md) | Traverses the dataset |
| [__MutableObjectMappedArray&nbsp;::&nbsp;getIterator__](util-MutableObjectMappedArray-getIterator.md) |  |
| [__MutableObjectMappedArray&nbsp;::&nbsp;\_\_serialize__](util-MutableObjectMappedArray-__serialize.md) |  |
| [__MutableObjectMappedArray&nbsp;::&nbsp;\_\_unserialize__](util-MutableObjectMappedArray-__unserialize.md) |  |
| [__MutableObjectMappedArray&nbsp;::&nbsp;\_\_debugInfo__](util-MutableObjectMappedArray-__debugInfo.md) |  |
| [__MutableObjectMappedArray&nbsp;::&nbsp;clone__](util-MutableObjectMappedArray-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
| [__MutableObjectMappedArray&nbsp;::&nbsp;addIterable__](util-MutableObjectMappedArray-addIterable.md) | Add elements from an iterator |
| [__MutableObjectMappedArray&nbsp;::&nbsp;remove__](util-MutableObjectMappedArray-remove.md) | Remove a value from all assigned keys within this map  Searches for a specified value and removes all occurrences that it finds |
