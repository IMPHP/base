# [Base](Base.md) / [Util](Util.md) / Set
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
class Set extends im\util\BaseCollection implements im\util\ListArray {

    // Methods
    __construct(iterable $values = null): mixed
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
| [__Set&nbsp;::&nbsp;\_\_construct__](Util-Set___construct.md) |  |
| [__Set&nbsp;::&nbsp;join__](Util-Set_join.md) | Join all the values in the list into one string |
| [__Set&nbsp;::&nbsp;addIterable__](Util-Set_addIterable.md) | Add values from an `iterable` object or array |
| [__Set&nbsp;::&nbsp;add__](Util-Set_add.md) | Add a value to this list |
| [__Set&nbsp;::&nbsp;remove__](Util-Set_remove.md) | Remove a value from the list |
| [__Set&nbsp;::&nbsp;equals__](Util-Set_equals.md) | Compare an object against this instance. |
| [__Set&nbsp;::&nbsp;contains__](Util-Set_contains.md) | Checks to see if a value exists in this list |
| [__Set&nbsp;::&nbsp;combineArrays__](Util-Set_combineArrays.md) | Combine two arrays recursively |
| [__Set&nbsp;::&nbsp;lock__](Util-Set_lock.md) | Lock the dataset to make it immutable |
| [__Set&nbsp;::&nbsp;clear__](Util-Set_clear.md) | Clear the collection. This will remove all data from the |
| [__Set&nbsp;::&nbsp;length__](Util-Set_length.md) | Get the current length of the collection |
| [__Set&nbsp;::&nbsp;toArray__](Util-Set_toArray.md) | Builds a PHP array containing all of the current values within |
| [__Set&nbsp;::&nbsp;copy__](Util-Set_copy.md) | Clone this instance and return it |
| [__Set&nbsp;::&nbsp;getIterator__](Util-Set_getIterator.md) |  |
