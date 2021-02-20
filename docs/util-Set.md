# [Base](base.md) / [Utilities](util.md) / Set
 > im\util\Set
____

## Description
An implementation of the `ListArray` interface.

This is a really slow `SetArray` and should properly not be
used in a high produktion invironment. It's fine for a local
application where a single user accesses it at one time, but
anything besides that and testing, you should consider
using `im\util\HashSet` instead.

## Synopsis
```php
class Set extends im\util\BaseCollection implements im\util\Collection, Traversable, IteratorAggregate, im\util\ListArray {

    // Methods
    public __construct(null|iterable $values = NULL)
    public join(null|string $delimiter = NULL): string
    public addIterable(iterable $list): void
    public add(mixed $value): void
    public remove(mixed $value): void
    public equals(object $other): bool
    public contains(mixed $value): bool

    // Inherited Methods
    public static combineArrays(array &$array1, array &$array2): array
    public lock(): void
    public clear(): void
    public length(): int
    public toArray(): array
    public copy(null|callable $sort = NULL): static
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__Set&nbsp;::&nbsp;\_\_construct__](util-Set-__construct.md) |  |
| [__Set&nbsp;::&nbsp;join__](util-Set-join.md) | Join all the values in the list into one string |
| [__Set&nbsp;::&nbsp;addIterable__](util-Set-addIterable.md) | Add values from an `iterable` object or array |
| [__Set&nbsp;::&nbsp;add__](util-Set-add.md) | Add a value to this list |
| [__Set&nbsp;::&nbsp;remove__](util-Set-remove.md) | Remove a value from the list |
| [__Set&nbsp;::&nbsp;equals__](util-Set-equals.md) | Compare an object against this instance |
| [__Set&nbsp;::&nbsp;contains__](util-Set-contains.md) | Checks to see if a value exists in this list |
| [__Set&nbsp;::&nbsp;combineArrays__](util-Set-combineArrays.md) | Combine two arrays recursively  This is similar to `array_merge_recursive()`, but this method does not alter the structure |
| [__Set&nbsp;::&nbsp;lock__](util-Set-lock.md) | Lock the dataset to make it immutable |
| [__Set&nbsp;::&nbsp;clear__](util-Set-clear.md) | Clear the collection |
| [__Set&nbsp;::&nbsp;length__](util-Set-length.md) | Get the current length of the collection |
| [__Set&nbsp;::&nbsp;toArray__](util-Set-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__Set&nbsp;::&nbsp;copy__](util-Set-copy.md) | Clone this instance and return it |
