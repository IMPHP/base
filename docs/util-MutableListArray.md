# [Base](base.md) / [Utilities](util.md) / MutableListArray
 > im\util\MutableListArray
____

## Description
An modifiable structured list implementation

## Synopsis
```php
interface MutableListArray implements im\util\ImmutableListArray, IteratorAggregate, im\features\Serializable, im\features\Cloneable, Traversable, im\util\Collection {

    // Methods
    clear(): void
    add(mixed $value): void
    remove(mixed $value): int
    addIterable(iterable $list): void

    // Inherited Methods
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
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__MutableListArray&nbsp;::&nbsp;clear__](util-MutableListArray-clear.md) | Clear the list |
| [__MutableListArray&nbsp;::&nbsp;add__](util-MutableListArray-add.md) | Add a value to this list |
| [__MutableListArray&nbsp;::&nbsp;remove__](util-MutableListArray-remove.md) | Remove a value from the list |
| [__MutableListArray&nbsp;::&nbsp;addIterable__](util-MutableListArray-addIterable.md) | Add values from an `iterable` object or array |
| [__MutableListArray&nbsp;::&nbsp;join__](util-MutableListArray-join.md) | Join all the values in the list into one string |
| [__MutableListArray&nbsp;::&nbsp;contains__](util-MutableListArray-contains.md) | Checks to see if a value exists in this list |
| [__MutableListArray&nbsp;::&nbsp;filter__](util-MutableListArray-filter.md) | Filters elements of the collection |
| [__MutableListArray&nbsp;::&nbsp;length__](util-MutableListArray-length.md) | Get the current length of the collection |
| [__MutableListArray&nbsp;::&nbsp;toArray__](util-MutableListArray-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__~MutableListArray&nbsp;::&nbsp;copy~__](util-MutableListArray-copy.md) | Clone this instance and return it |
| [__MutableListArray&nbsp;::&nbsp;equals__](util-MutableListArray-equals.md) | Compare an object against this instance |
| [__MutableListArray&nbsp;::&nbsp;traverse__](util-MutableListArray-traverse.md) | Traverses the dataset |
| [__MutableListArray&nbsp;::&nbsp;getIterator__](util-MutableListArray-getIterator.md) |  |
| [__MutableListArray&nbsp;::&nbsp;\_\_serialize__](util-MutableListArray-__serialize.md) |  |
| [__MutableListArray&nbsp;::&nbsp;\_\_unserialize__](util-MutableListArray-__unserialize.md) |  |
| [__MutableListArray&nbsp;::&nbsp;\_\_debugInfo__](util-MutableListArray-__debugInfo.md) |  |
| [__MutableListArray&nbsp;::&nbsp;clone__](util-MutableListArray-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
