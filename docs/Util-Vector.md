# [Base](Base.md) / [Util](Util.md) / Vector
 > im\util\Vector
____

## Description
An implementation of the `IndexArray` interface.

## Synopsis
```php
class Vector extends im\util\BaseCollection implements im\util\IndexArray {

    // Methods
    __construct(iterable $values = null): mixed
    indexOf(mixed $value): int
    get(int $key, mixed $defVal = null): mixed
    set(int $key, mixed $value): void
    unset(int $key): mixed
    insert(int $key, mixed $value): void
    join(string $delimiter = null): string
    addIterable(iterable $list): void
    add(mixed $value): void
    remove(mixed $value): void
    equals(object $other): bool
    contains(mixed $value): bool
    static combineArrays(array &$array1, array &$array2): array
    lock(): void
    clear(): void
    length(): int
    toArray(): array
    copy(callable $sort = null): static
    getIterator(): Traversable
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__Vector&nbsp;::&nbsp;\_\_construct__](Util-Vector___construct.md) |  |
| [__Vector&nbsp;::&nbsp;indexOf__](Util-Vector_indexOf.md) | Returns the positional key for a given value |
| [__Vector&nbsp;::&nbsp;get__](Util-Vector_get.md) | Returns the value for a positional key |
| [__Vector&nbsp;::&nbsp;set__](Util-Vector_set.md) | Set the value on a positional key |
| [__Vector&nbsp;::&nbsp;unset__](Util-Vector_unset.md) | Remove the element at a positional key |
| [__Vector&nbsp;::&nbsp;insert__](Util-Vector_insert.md) | Insert a value into a positional key |
| [__Vector&nbsp;::&nbsp;join__](Util-Vector_join.md) | Join all the values in the list into one string |
| [__Vector&nbsp;::&nbsp;addIterable__](Util-Vector_addIterable.md) | Add values from an `iterable` object or array |
| [__Vector&nbsp;::&nbsp;add__](Util-Vector_add.md) | Add a value to this list |
| [__Vector&nbsp;::&nbsp;remove__](Util-Vector_remove.md) | Remove a value from the list |
| [__Vector&nbsp;::&nbsp;equals__](Util-Vector_equals.md) | Compare an object against this instance. |
| [__Vector&nbsp;::&nbsp;contains__](Util-Vector_contains.md) | Checks to see if a value exists in this list |
| [__Vector&nbsp;::&nbsp;combineArrays__](Util-Vector_combineArrays.md) | Combine two arrays recursively |
| [__Vector&nbsp;::&nbsp;lock__](Util-Vector_lock.md) | Lock the dataset to make it immutable |
| [__Vector&nbsp;::&nbsp;clear__](Util-Vector_clear.md) | Clear the collection. This will remove all data from the |
| [__Vector&nbsp;::&nbsp;length__](Util-Vector_length.md) | Get the current length of the collection |
| [__Vector&nbsp;::&nbsp;toArray__](Util-Vector_toArray.md) | Builds a PHP array containing all of the current values within |
| [__Vector&nbsp;::&nbsp;copy__](Util-Vector_copy.md) | Clone this instance and return it |
| [__Vector&nbsp;::&nbsp;getIterator__](Util-Vector_getIterator.md) |  |
