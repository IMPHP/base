# [Base](base.md) / [Utilities](util.md) / ListArray
 > im\util\ListArray
____

## Description
Defines an interface for a list array.

A list array is a very basic list that allows you to add content and later iterate through it.
It does not define any specific structure for the contained data and as such it's not
possible to access individual elements.

> :warning: **Deprecated**  
> This interface has been replaced by `im\util\ImmutableListArray` and `im\util\MutableListArray`.  

## Synopsis
```php
interface ListArray implements im\util\MutableListArray, im\util\Collection, Traversable, im\features\Cloneable, im\features\Serializable, IteratorAggregate, im\util\ImmutableListArray {

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
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__ListArray&nbsp;::&nbsp;clear__](util-ListArray-clear.md) | Clear the list |
| [__ListArray&nbsp;::&nbsp;add__](util-ListArray-add.md) | Add a value to this list |
| [__ListArray&nbsp;::&nbsp;remove__](util-ListArray-remove.md) | Remove a value from the list |
| [__ListArray&nbsp;::&nbsp;addIterable__](util-ListArray-addIterable.md) | Add values from an `iterable` object or array |
| [__ListArray&nbsp;::&nbsp;join__](util-ListArray-join.md) | Join all the values in the list into one string |
| [__ListArray&nbsp;::&nbsp;contains__](util-ListArray-contains.md) | Checks to see if a value exists in this list |
| [__ListArray&nbsp;::&nbsp;filter__](util-ListArray-filter.md) | Filters elements of the collection |
| [__ListArray&nbsp;::&nbsp;length__](util-ListArray-length.md) | Get the current length of the collection |
| [__ListArray&nbsp;::&nbsp;toArray__](util-ListArray-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__~ListArray&nbsp;::&nbsp;copy~__](util-ListArray-copy.md) | Clone this instance and return it |
| [__ListArray&nbsp;::&nbsp;equals__](util-ListArray-equals.md) | Compare an object against this instance |
| [__ListArray&nbsp;::&nbsp;traverse__](util-ListArray-traverse.md) | Traverses the dataset |
| [__ListArray&nbsp;::&nbsp;getIterator__](util-ListArray-getIterator.md) |  |
| [__ListArray&nbsp;::&nbsp;\_\_serialize__](util-ListArray-__serialize.md) |  |
| [__ListArray&nbsp;::&nbsp;\_\_unserialize__](util-ListArray-__unserialize.md) |  |
| [__ListArray&nbsp;::&nbsp;\_\_debugInfo__](util-ListArray-__debugInfo.md) |  |
| [__ListArray&nbsp;::&nbsp;clone__](util-ListArray-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
