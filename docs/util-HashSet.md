# [Base](base.md) / [Utilities](util.md) / HashSet
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

 > This test was done using small and simple strings as value. Objects will be faster for `HashSet` due to object id's and really long string data will be much slower, because there are more data to run through when creating the hash id.  

## Synopsis
```php
class HashSet extends im\util\Set implements im\util\ListArray, IteratorAggregate, Traversable, im\util\Collection {

    // Methods
    public add(mixed $value): void
    public remove(mixed $value): void
    public equals(object $other): bool
    public contains(mixed $value): bool
    public toArray(): array
    public copy(null|callable $sort = NULL): static
    public getIterator(): Traversable

    // Inherited Methods
    public __construct(null|iterable $values = NULL)
    public join(null|string $delimiter = NULL): string
    public addIterable(iterable $list): void
    public static combineArrays(array &$array1, array &$array2): array
    public lock(): void
    public clear(): void
    public length(): int
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__HashSet&nbsp;::&nbsp;add__](util-HashSet-add.md) | Add a value to this list |
| [__HashSet&nbsp;::&nbsp;remove__](util-HashSet-remove.md) | Remove a value from the list |
| [__HashSet&nbsp;::&nbsp;equals__](util-HashSet-equals.md) | Compare an object against this instance |
| [__HashSet&nbsp;::&nbsp;contains__](util-HashSet-contains.md) | Checks to see if a value exists in this list |
| [__HashSet&nbsp;::&nbsp;toArray__](util-HashSet-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__HashSet&nbsp;::&nbsp;copy__](util-HashSet-copy.md) | Clone this instance and return it |
| [__HashSet&nbsp;::&nbsp;getIterator__](util-HashSet-getIterator.md) |  |
| [__HashSet&nbsp;::&nbsp;\_\_construct__](util-HashSet-__construct.md) |  |
| [__HashSet&nbsp;::&nbsp;join__](util-HashSet-join.md) | Join all the values in the list into one string |
| [__HashSet&nbsp;::&nbsp;addIterable__](util-HashSet-addIterable.md) | Add values from an `iterable` object or array |
| [__HashSet&nbsp;::&nbsp;combineArrays__](util-HashSet-combineArrays.md) | Combine two arrays recursively  This is similar to `array_merge_recursive()`, but this method does not alter the structure |
| [__HashSet&nbsp;::&nbsp;lock__](util-HashSet-lock.md) | Lock the dataset to make it immutable |
| [__HashSet&nbsp;::&nbsp;clear__](util-HashSet-clear.md) | Clear the collection |
| [__HashSet&nbsp;::&nbsp;length__](util-HashSet-length.md) | Get the current length of the collection |
