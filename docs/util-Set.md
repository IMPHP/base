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
class Set extends im\util\HashSet implements im\util\MutableListArray, im\util\ImmutableListArray, im\util\ListArray, IteratorAggregate, Traversable, im\util\Collection {

    // Inherited Properties
    protected array $dataset = Array

    // Inherited Methods
    public toArray(): array
    public traverse(callable $func): bool
    public copy(null|callable $sort = NULL): static
    public join(null|string $delimiter = NULL): string
    public contains(mixed $value): bool
    public add(mixed $value): void
    public remove(mixed $value): int
    public addIterable(iterable $list): void
    public equals(object $other): bool
    public static combineArrays(array &$array1, array &$array2): array
    public lock(): void
    public clear(): void
    public length(): int
}
```

## Properties
| Name | Description |
| :--- | :---------- |
| [__Set&nbsp;::&nbsp;$dataset__](util-Set-var_dataset.md) | Internal property containing the dataset for the collection |

## Methods
| Name | Description |
| :--- | :---------- |
| [__Set&nbsp;::&nbsp;toArray__](util-Set-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__Set&nbsp;::&nbsp;traverse__](util-Set-traverse.md) | Traverses the dataset |
| [__Set&nbsp;::&nbsp;copy__](util-Set-copy.md) | Clone this instance and return it |
| [__Set&nbsp;::&nbsp;join__](util-Set-join.md) |  |
| [__Set&nbsp;::&nbsp;contains__](util-Set-contains.md) |  |
| [__Set&nbsp;::&nbsp;add__](util-Set-add.md) |  |
| [__Set&nbsp;::&nbsp;remove__](util-Set-remove.md) |  |
| [__Set&nbsp;::&nbsp;addIterable__](util-Set-addIterable.md) |  |
| [__Set&nbsp;::&nbsp;equals__](util-Set-equals.md) | Compare an object against this instance |
| [__Set&nbsp;::&nbsp;combineArrays__](util-Set-combineArrays.md) | Combine two arrays recursively  This is similar to `array_merge_recursive()`, but this method does not alter the structure |
| [__~Set&nbsp;::&nbsp;lock~__](util-Set-lock.md) | Lock the dataset to make it immutable |
| [__Set&nbsp;::&nbsp;clear__](util-Set-clear.md) | Clear the collection |
| [__Set&nbsp;::&nbsp;length__](util-Set-length.md) | Get the current length of the collection |
