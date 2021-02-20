# [Base](base.md) / [Utilities](util.md) / Vector
 > im\util\Vector
____

## Description
An implementation of the `IndexArray` interface.

## Synopsis
```php
class Vector extends im\util\BaseCollection implements im\util\Collection, Traversable, IteratorAggregate, im\util\IndexArray, im\util\ListArray {

    // Methods
    public __construct(null|iterable $values = NULL)
    public indexOf(mixed $value): int
    public get(int $key, mixed $defVal = NULL): mixed
    public set(int $key, mixed $value): void
    public unset(int $key): mixed
    public insert(int $key, mixed $value): void
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
| [__Vector&nbsp;::&nbsp;\_\_construct__](util-Vector-__construct.md) |  |
| [__Vector&nbsp;::&nbsp;indexOf__](util-Vector-indexOf.md) | Returns the positional key for a given value  The key that is returned is for the first occurance of the specified value |
| [__Vector&nbsp;::&nbsp;get__](util-Vector-get.md) | Returns the value for a positional key |
| [__Vector&nbsp;::&nbsp;set__](util-Vector-set.md) | Set the value on a positional key  Unlike `add()`, this will set the value for a specified key, rather than just appending the value to the end |
| [__Vector&nbsp;::&nbsp;unset__](util-Vector-unset.md) | Remove the element at a positional key |
| [__Vector&nbsp;::&nbsp;insert__](util-Vector-insert.md) | Insert a value into a positional key  Unlike `set()` this will not override the existing value |
| [__Vector&nbsp;::&nbsp;join__](util-Vector-join.md) | Join all the values in the list into one string |
| [__Vector&nbsp;::&nbsp;addIterable__](util-Vector-addIterable.md) | Add values from an `iterable` object or array |
| [__Vector&nbsp;::&nbsp;add__](util-Vector-add.md) | Add a value to this list |
| [__Vector&nbsp;::&nbsp;remove__](util-Vector-remove.md) | Remove a value from the list |
| [__Vector&nbsp;::&nbsp;equals__](util-Vector-equals.md) | Compare an object against this instance |
| [__Vector&nbsp;::&nbsp;contains__](util-Vector-contains.md) | Checks to see if a value exists in this list |
| [__Vector&nbsp;::&nbsp;combineArrays__](util-Vector-combineArrays.md) | Combine two arrays recursively  This is similar to `array_merge_recursive()`, but this method does not alter the structure |
| [__Vector&nbsp;::&nbsp;lock__](util-Vector-lock.md) | Lock the dataset to make it immutable |
| [__Vector&nbsp;::&nbsp;clear__](util-Vector-clear.md) | Clear the collection |
| [__Vector&nbsp;::&nbsp;length__](util-Vector-length.md) | Get the current length of the collection |
| [__Vector&nbsp;::&nbsp;toArray__](util-Vector-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__Vector&nbsp;::&nbsp;copy__](util-Vector-copy.md) | Clone this instance and return it |
