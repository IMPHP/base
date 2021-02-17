# [Base](Base.md) / [Util](Util.md) / HashSet
 > im\util\HashSet
____

## Description
A much faster `Set` to be used when you have a lot of data.

So I made some speed tests on my workstation, to compare this
HashSet to it's parent. I created some loops that simply added values to
each type of Set. _(These numbers will differ depending on the setup they are running in)_

 | Iterations | Set       | HashSet |
 | ---------: | --------: | ------: |
 |     100    |     0 ms  |   0 ms  |
 |    1000    |     2 ms  |   1 ms  |
 |   10000    |   207 ms  |   5 ms  |
 |  100000    | 20991 ms  |  54 ms  |
 | 1000000    | + 36 min  | 650 ms  |

If you are around 100 values, it does not really make a difference which one you use.
This makes sense. Yes there are some overheat with `Set` that is checks for the
existence of the value everytime you add one, but there is also some overheat with `HashSet`
that it has to create hash values for keyed storage. So around 100 values these two overheats
seams to cancel eachother out. But as soon as you are moving to far above 100 values, `HashSet`
really starts showing off.

    This test was done using small and simple strings as value. Objects will be faster for `HashSet`
    due to object id's and really long string data will be much slower, because there are more data to run through
    when creating the hash id.  

## Synopsis
```php
class HashSet extends im\util\Set {

    // Methods
    add(mixed $value): void
    remove(mixed $value): void
    equals(object $other): bool
    contains(mixed $value): bool
    toArray(): array
    copy(callable $sort = null): static
    getIterator(): Traversable
    __construct(iterable $values = null): mixed
    join(string $delimiter = null): string
    addIterable(iterable $list): void
    static combineArrays(array &$array1, array &$array2): array
    lock(): void
    clear(): void
    length(): int
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__HashSet&nbsp;::&nbsp;add__](Util-HashSet_add.md) | Add a value to this list |
| [__HashSet&nbsp;::&nbsp;remove__](Util-HashSet_remove.md) | Remove a value from the list |
| [__HashSet&nbsp;::&nbsp;equals__](Util-HashSet_equals.md) | Compare an object against this instance. |
| [__HashSet&nbsp;::&nbsp;contains__](Util-HashSet_contains.md) | Checks to see if a value exists in this list |
| [__HashSet&nbsp;::&nbsp;toArray__](Util-HashSet_toArray.md) | Builds a PHP array containing all of the current values within |
| [__HashSet&nbsp;::&nbsp;copy__](Util-HashSet_copy.md) | Clone this instance and return it |
| [__HashSet&nbsp;::&nbsp;getIterator__](Util-HashSet_getIterator.md) |  |
| [__HashSet&nbsp;::&nbsp;\_\_construct__](Util-HashSet___construct.md) |  |
| [__HashSet&nbsp;::&nbsp;join__](Util-HashSet_join.md) | Join all the values in the list into one string |
| [__HashSet&nbsp;::&nbsp;addIterable__](Util-HashSet_addIterable.md) | Add values from an `iterable` object or array |
| [__HashSet&nbsp;::&nbsp;combineArrays__](Util-HashSet_combineArrays.md) | Combine two arrays recursively |
| [__HashSet&nbsp;::&nbsp;lock__](Util-HashSet_lock.md) | Lock the dataset to make it immutable |
| [__HashSet&nbsp;::&nbsp;clear__](Util-HashSet_clear.md) | Clear the collection. This will remove all data from the |
| [__HashSet&nbsp;::&nbsp;length__](Util-HashSet_length.md) | Get the current length of the collection |
