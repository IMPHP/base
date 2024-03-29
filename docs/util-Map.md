# [Base](base.md) / [Utilities](util.md) / Map
 > im\util\Map
____

## Description
An unmodifiable map implementation

## Synopsis
```php
class Map extends im\util\BaseCollection implements im\util\Collection, Traversable, im\features\Cloneable, im\features\Serializable, IteratorAggregate, im\util\MapArray, im\util\MutableStringMappedArray, im\util\ImmutableMappedArray, im\util\MutableMappedArray, im\util\ImmutableStringMappedArray {

    // Methods
    public __construct(null|iterable $map = NULL)
    public clear(): void
    public toArray(): array
    public length(): int
    public addIterable(iterable $map): void
    public remove(mixed $value): int
    public set(string $key, mixed $value): mixed
    public unset(string $key): mixed
    public filter(callable $filter): static
    public contains(mixed $value): bool
    public getValues(): im\util\ListArray
    public getKeys(): im\util\ListArray
    public get(string $key, mixed $defVal = NULL): mixed
    public isset(string $key): bool
    public find(mixed $value): null|string
    public equals(object $other): bool
    public copy(null|callable $sort = NULL): static

    // Inherited Methods
    public static combineArrays(array &$array1, array &$array2): array
    public lock(): void
    public traverse(callable $func): bool
    public clone(): static
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__Map&nbsp;::&nbsp;\_\_construct__](util-Map-__construct.md) |  |
| [__Map&nbsp;::&nbsp;clear__](util-Map-clear.md) |  |
| [__Map&nbsp;::&nbsp;toArray__](util-Map-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__Map&nbsp;::&nbsp;length__](util-Map-length.md) | Get the current length of the collection |
| [__Map&nbsp;::&nbsp;addIterable__](util-Map-addIterable.md) |  |
| [__Map&nbsp;::&nbsp;remove__](util-Map-remove.md) |  |
| [__Map&nbsp;::&nbsp;set__](util-Map-set.md) |  |
| [__Map&nbsp;::&nbsp;unset__](util-Map-unset.md) |  |
| [__Map&nbsp;::&nbsp;filter__](util-Map-filter.md) | Filters elements of the collection |
| [__Map&nbsp;::&nbsp;contains__](util-Map-contains.md) |  |
| [__Map&nbsp;::&nbsp;getValues__](util-Map-getValues.md) |  |
| [__Map&nbsp;::&nbsp;getKeys__](util-Map-getKeys.md) |  |
| [__Map&nbsp;::&nbsp;get__](util-Map-get.md) |  |
| [__Map&nbsp;::&nbsp;isset__](util-Map-isset.md) |  |
| [__Map&nbsp;::&nbsp;find__](util-Map-find.md) |  |
| [__Map&nbsp;::&nbsp;equals__](util-Map-equals.md) | Compare an object against this instance |
| [__~Map&nbsp;::&nbsp;copy~__](util-Map-copy.md) | Clone this instance and return it |
| [__Map&nbsp;::&nbsp;combineArrays__](util-Map-combineArrays.md) | Combine two arrays recursively  This is similar to `array_merge_recursive()`, but this method does not alter the structure |
| [__~Map&nbsp;::&nbsp;lock~__](util-Map-lock.md) | Lock the dataset to make it immutable |
| [__Map&nbsp;::&nbsp;traverse__](util-Map-traverse.md) | Traverses the dataset |
| [__Map&nbsp;::&nbsp;clone__](util-Map-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
