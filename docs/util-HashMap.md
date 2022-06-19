# [Base](base.md) / [Utilities](util.md) / HashMap
 > im\util\HashMap
____

## Description
An modifiable map implementation using hashed keys

## Synopsis
```php
class HashMap extends im\util\BaseCollection implements im\util\Collection, Traversable, im\features\Cloneable, im\features\Serializable, IteratorAggregate, im\util\MapArray, im\util\MutableObjectMappedArray, im\util\ImmutableMappedArray, im\util\MutableMappedArray, im\util\ImmutableObjectMappedArray {

    // Methods
    public __construct(null|iterable $map = NULL)
    public clear(): void
    public toArray(): array
    public length(): int
    public equals(object $other): bool
    public traverse(callable $func): bool
    public copy(null|callable $sort = NULL): static
    public addIterable(iterable $map): void
    public remove(mixed $value): int
    public set(mixed $key, mixed $value): mixed
    public unset(mixed $key): mixed
    public filter(callable $filter): static
    public contains(mixed $value): bool
    public getValues(): im\util\ListArray
    public getKeys(): im\util\ListArray
    public get(mixed $key, mixed $defVal = NULL): mixed
    public isset(mixed $key): bool
    public find(mixed $value): mixed

    // Inherited Methods
    public static combineArrays(array &$array1, array &$array2): array
    public lock(): void
    public clone(): static
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__HashMap&nbsp;::&nbsp;\_\_construct__](util-HashMap-__construct.md) |  |
| [__HashMap&nbsp;::&nbsp;clear__](util-HashMap-clear.md) |  |
| [__HashMap&nbsp;::&nbsp;toArray__](util-HashMap-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__HashMap&nbsp;::&nbsp;length__](util-HashMap-length.md) | Get the current length of the collection |
| [__HashMap&nbsp;::&nbsp;equals__](util-HashMap-equals.md) | Compare an object against this instance |
| [__HashMap&nbsp;::&nbsp;traverse__](util-HashMap-traverse.md) | Traverses the dataset |
| [__~HashMap&nbsp;::&nbsp;copy~__](util-HashMap-copy.md) | Clone this instance and return it |
| [__HashMap&nbsp;::&nbsp;addIterable__](util-HashMap-addIterable.md) |  |
| [__HashMap&nbsp;::&nbsp;remove__](util-HashMap-remove.md) |  |
| [__HashMap&nbsp;::&nbsp;set__](util-HashMap-set.md) |  |
| [__HashMap&nbsp;::&nbsp;unset__](util-HashMap-unset.md) |  |
| [__HashMap&nbsp;::&nbsp;filter__](util-HashMap-filter.md) | Filters elements of the collection |
| [__HashMap&nbsp;::&nbsp;contains__](util-HashMap-contains.md) |  |
| [__HashMap&nbsp;::&nbsp;getValues__](util-HashMap-getValues.md) |  |
| [__HashMap&nbsp;::&nbsp;getKeys__](util-HashMap-getKeys.md) |  |
| [__HashMap&nbsp;::&nbsp;get__](util-HashMap-get.md) |  |
| [__HashMap&nbsp;::&nbsp;isset__](util-HashMap-isset.md) |  |
| [__HashMap&nbsp;::&nbsp;find__](util-HashMap-find.md) |  |
| [__HashMap&nbsp;::&nbsp;combineArrays__](util-HashMap-combineArrays.md) | Combine two arrays recursively  This is similar to `array_merge_recursive()`, but this method does not alter the structure |
| [__~HashMap&nbsp;::&nbsp;lock~__](util-HashMap-lock.md) | Lock the dataset to make it immutable |
| [__HashMap&nbsp;::&nbsp;clone__](util-HashMap-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
