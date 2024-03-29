# [Base](base.md) / [Utilities](util.md) / MutableStructuredList
 > im\util\MutableStructuredList
____

## Description
Defines a modifiable structured list

## Synopsis
```php
interface MutableStructuredList implements im\util\MutableListArray, im\util\ImmutableStructuredList, im\util\Collection, Traversable, im\features\Cloneable, im\features\Serializable, IteratorAggregate, im\util\ImmutableListArray {

    // Methods
    set(int $key, mixed $value): mixed
    unset(int $key): mixed
    insert(int $key, mixed $value): bool
    sort(callable $filter): void

    // Inherited Methods
    clear(): void
    add(mixed $value): void
    remove(mixed $value): int
    addIterable(iterable $list): void
    join(null|string $delimiter = NULL): string
    contains(mixed $value): bool
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
    indexOf(mixed $value): int
    get(int $key, mixed $defVal = NULL): mixed
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__MutableStructuredList&nbsp;::&nbsp;set__](util-MutableStructuredList-set.md) | Set the value on a positional key  Unlike `add()`, this will set the value for a specified key, rather than just appending the value to the end |
| [__MutableStructuredList&nbsp;::&nbsp;unset__](util-MutableStructuredList-unset.md) | Remove the element at a positional key |
| [__MutableStructuredList&nbsp;::&nbsp;insert__](util-MutableStructuredList-insert.md) | Insert a value into a positional key  Unlike `set()` this will not override the existing value |
| [__MutableStructuredList&nbsp;::&nbsp;sort__](util-MutableStructuredList-sort.md) | Sort the collection by value |
| [__MutableStructuredList&nbsp;::&nbsp;clear__](util-MutableStructuredList-clear.md) | Clear the list |
| [__MutableStructuredList&nbsp;::&nbsp;add__](util-MutableStructuredList-add.md) | Add a value to this list |
| [__MutableStructuredList&nbsp;::&nbsp;remove__](util-MutableStructuredList-remove.md) | Remove a value from the list |
| [__MutableStructuredList&nbsp;::&nbsp;addIterable__](util-MutableStructuredList-addIterable.md) | Add values from an `iterable` object or array |
| [__MutableStructuredList&nbsp;::&nbsp;join__](util-MutableStructuredList-join.md) | Join all the values in the list into one string |
| [__MutableStructuredList&nbsp;::&nbsp;contains__](util-MutableStructuredList-contains.md) | Checks to see if a value exists in this list |
| [__MutableStructuredList&nbsp;::&nbsp;filter__](util-MutableStructuredList-filter.md) | Filters elements of the collection |
| [__MutableStructuredList&nbsp;::&nbsp;length__](util-MutableStructuredList-length.md) | Get the current length of the collection |
| [__MutableStructuredList&nbsp;::&nbsp;toArray__](util-MutableStructuredList-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__~MutableStructuredList&nbsp;::&nbsp;copy~__](util-MutableStructuredList-copy.md) | Clone this instance and return it |
| [__MutableStructuredList&nbsp;::&nbsp;equals__](util-MutableStructuredList-equals.md) | Compare an object against this instance |
| [__MutableStructuredList&nbsp;::&nbsp;traverse__](util-MutableStructuredList-traverse.md) | Traverses the dataset |
| [__MutableStructuredList&nbsp;::&nbsp;getIterator__](util-MutableStructuredList-getIterator.md) |  |
| [__MutableStructuredList&nbsp;::&nbsp;\_\_serialize__](util-MutableStructuredList-__serialize.md) |  |
| [__MutableStructuredList&nbsp;::&nbsp;\_\_unserialize__](util-MutableStructuredList-__unserialize.md) |  |
| [__MutableStructuredList&nbsp;::&nbsp;\_\_debugInfo__](util-MutableStructuredList-__debugInfo.md) |  |
| [__MutableStructuredList&nbsp;::&nbsp;clone__](util-MutableStructuredList-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
| [__MutableStructuredList&nbsp;::&nbsp;indexOf__](util-MutableStructuredList-indexOf.md) | Returns the positional key for a given value  The key that is returned is for the first occurance of the specified value |
| [__MutableStructuredList&nbsp;::&nbsp;get__](util-MutableStructuredList-get.md) | Returns the value for a positional key |
