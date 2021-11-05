# [Base](base.md) / [Utilities](util.md) / Vector
 > im\util\Vector
____

## Description
Defines an unmodifiable unstructured list

## Synopsis
```php
class Vector extends im\util\BaseCollection implements im\util\Collection, Traversable, IteratorAggregate, im\util\IndexArray, im\util\ImmutableStructuredList, im\util\MutableListArray, im\util\ImmutableListArray, im\util\MutableStructuredList, im\util\ListArray {

    // Inherited Properties
    protected array $dataset = Array

    // Methods
    public join(null|string $delimiter = NULL): string
    public contains(mixed $value): bool
    public indexOf(mixed $value): int
    public get(int $key, mixed $defVal = NULL): mixed
    public add(mixed $value): void
    public remove(mixed $value): int
    public addIterable(iterable $list): void
    public set(int $key, mixed $value): mixed
    public unset(int $key): mixed
    public insert(int $key, mixed $value): bool
    public equals(object $other): bool

    // Inherited Methods
    public static combineArrays(array &$array1, array &$array2): array
    public lock(): void
    public traverse(callable $func): bool
    public clear(): void
    public length(): int
    public toArray(): array
    public copy(null|callable $sort = NULL): static
}
```

## Properties
| Name | Description |
| :--- | :---------- |
| [__Vector&nbsp;::&nbsp;$dataset__](util-Vector-var_dataset.md) | Internal property containing the dataset for the collection |

## Methods
| Name | Description |
| :--- | :---------- |
| [__Vector&nbsp;::&nbsp;join__](util-Vector-join.md) |  |
| [__Vector&nbsp;::&nbsp;contains__](util-Vector-contains.md) |  |
| [__Vector&nbsp;::&nbsp;indexOf__](util-Vector-indexOf.md) |  |
| [__Vector&nbsp;::&nbsp;get__](util-Vector-get.md) |  |
| [__Vector&nbsp;::&nbsp;add__](util-Vector-add.md) |  |
| [__Vector&nbsp;::&nbsp;remove__](util-Vector-remove.md) |  |
| [__Vector&nbsp;::&nbsp;addIterable__](util-Vector-addIterable.md) |  |
| [__Vector&nbsp;::&nbsp;set__](util-Vector-set.md) |  |
| [__Vector&nbsp;::&nbsp;unset__](util-Vector-unset.md) |  |
| [__Vector&nbsp;::&nbsp;insert__](util-Vector-insert.md) |  |
| [__Vector&nbsp;::&nbsp;equals__](util-Vector-equals.md) | Compare an object against this instance |
| [__Vector&nbsp;::&nbsp;combineArrays__](util-Vector-combineArrays.md) | Combine two arrays recursively  This is similar to `array_merge_recursive()`, but this method does not alter the structure |
| [__~Vector&nbsp;::&nbsp;lock~__](util-Vector-lock.md) | Lock the dataset to make it immutable |
| [__Vector&nbsp;::&nbsp;traverse__](util-Vector-traverse.md) | Traverses the dataset |
| [__Vector&nbsp;::&nbsp;clear__](util-Vector-clear.md) | Clear the collection |
| [__Vector&nbsp;::&nbsp;length__](util-Vector-length.md) | Get the current length of the collection |
| [__Vector&nbsp;::&nbsp;toArray__](util-Vector-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__Vector&nbsp;::&nbsp;copy__](util-Vector-copy.md) | Clone this instance and return it |
