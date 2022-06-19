# [Base](base.md) / [Utilities](util.md) / Set
 > im\util\Set
____

## Description
An modifiable unstructured list implementation

> :warning: **Deprecated**  
> This class has been deprecated as it serves no purpose. Use the `im\util\HashSet` to optain a real and optimized Set Collection.  

 > This class no loger has any underlaying implementation. It simply extends `im\util\HashSet`.  

## Synopsis
```php
class Set extends im\util\HashSet implements im\util\MutableListArray, im\util\ImmutableListArray, im\util\ListArray, IteratorAggregate, im\features\Serializable, im\features\Cloneable, Traversable, im\util\Collection {

    // Inherited Methods
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
    public static combineArrays(array &$array1, array &$array2): array
    public lock(): void
    public clone(): static
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__Set&nbsp;::&nbsp;filter__](util-Set-filter.md) | Filters elements of the collection |
| [__Set&nbsp;::&nbsp;toArray__](util-Set-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__Set&nbsp;::&nbsp;length__](util-Set-length.md) | Get the current length of the collection |
| [__Set&nbsp;::&nbsp;traverse__](util-Set-traverse.md) | Traverses the dataset |
| [__~Set&nbsp;::&nbsp;copy~__](util-Set-copy.md) | Clone this instance and return it |
| [__Set&nbsp;::&nbsp;join__](util-Set-join.md) |  |
| [__Set&nbsp;::&nbsp;contains__](util-Set-contains.md) |  |
| [__Set&nbsp;::&nbsp;clear__](util-Set-clear.md) |  |
| [__Set&nbsp;::&nbsp;add__](util-Set-add.md) |  |
| [__Set&nbsp;::&nbsp;remove__](util-Set-remove.md) |  |
| [__Set&nbsp;::&nbsp;addIterable__](util-Set-addIterable.md) |  |
| [__Set&nbsp;::&nbsp;equals__](util-Set-equals.md) | Compare an object against this instance |
| [__Set&nbsp;::&nbsp;combineArrays__](util-Set-combineArrays.md) | Combine two arrays recursively  This is similar to `array_merge_recursive()`, but this method does not alter the structure |
| [__~Set&nbsp;::&nbsp;lock~__](util-Set-lock.md) | Lock the dataset to make it immutable |
| [__Set&nbsp;::&nbsp;clone__](util-Set-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
