# [Base](base.md) / [Utilities](util.md) / HashSet
 > im\util\HashSet
____

## Description
An modifiable unstructured list implementation

## Synopsis
```php
class HashSet extends im\util\BaseCollection implements im\util\Collection, Traversable, im\features\Cloneable, im\features\Serializable, IteratorAggregate, im\util\ListArray, im\util\ImmutableListArray, im\util\MutableListArray {

    // Methods
    public filter(callable $filter): static
    public toArray(): array
    public length(): int
    public traverse(callable $func): bool
    public copy(null|callable $sort = NULL): static
    public join(null|string $delimiter = NULL): string
    public contains(mixed $value): bool
    public clear(): void
    public add(mixed $value): void
    public remove(mixed $value): int
    public addIterable(iterable $list): void
    public equals(object $other): bool

    // Inherited Methods
    public static combineArrays(array &$array1, array &$array2): array
    public lock(): void
    public clone(): static
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__HashSet&nbsp;::&nbsp;filter__](util-HashSet-filter.md) | Filters elements of the collection |
| [__HashSet&nbsp;::&nbsp;toArray__](util-HashSet-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__HashSet&nbsp;::&nbsp;length__](util-HashSet-length.md) | Get the current length of the collection |
| [__HashSet&nbsp;::&nbsp;traverse__](util-HashSet-traverse.md) | Traverses the dataset |
| [__~HashSet&nbsp;::&nbsp;copy~__](util-HashSet-copy.md) | Clone this instance and return it |
| [__HashSet&nbsp;::&nbsp;join__](util-HashSet-join.md) |  |
| [__HashSet&nbsp;::&nbsp;contains__](util-HashSet-contains.md) |  |
| [__HashSet&nbsp;::&nbsp;clear__](util-HashSet-clear.md) |  |
| [__HashSet&nbsp;::&nbsp;add__](util-HashSet-add.md) |  |
| [__HashSet&nbsp;::&nbsp;remove__](util-HashSet-remove.md) |  |
| [__HashSet&nbsp;::&nbsp;addIterable__](util-HashSet-addIterable.md) |  |
| [__HashSet&nbsp;::&nbsp;equals__](util-HashSet-equals.md) | Compare an object against this instance |
| [__HashSet&nbsp;::&nbsp;combineArrays__](util-HashSet-combineArrays.md) | Combine two arrays recursively  This is similar to `array_merge_recursive()`, but this method does not alter the structure |
| [__~HashSet&nbsp;::&nbsp;lock~__](util-HashSet-lock.md) | Lock the dataset to make it immutable |
| [__HashSet&nbsp;::&nbsp;clone__](util-HashSet-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
