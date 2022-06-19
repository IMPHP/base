# [Base](base.md) / [Utilities](util.md) / Queue
 > im\util\Queue
____

## Description
This stack-able pushes values to the top while
popping them from the bottom.

> :warning: **Deprecated**  
> This class has been replaced by `im\util\FIFOStack`  

 > This is just a reference class that extends `im\util\FIFOStack`  

## Synopsis
```php
class Queue extends im\util\FIFOStack implements IteratorAggregate, im\features\Serializable, im\features\Cloneable, Traversable, im\util\Collection {

    // Inherited Methods
    public push(mixed $value): void
    public pop(): mixed
    public peak(): mixed
    public __construct()
    public clear(): void
    public length(): int
    public toArray(): array
    public get(): mixed
    public equals(object $other): bool
    public traverse(callable $func): bool
    public copy(null|callable $sort = NULL): static
    public static combineArrays(array &$array1, array &$array2): array
    public lock(): void
    public clone(): static
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__Queue&nbsp;::&nbsp;push__](util-Queue-push.md) | Push a new value into this stackable instance |
| [__Queue&nbsp;::&nbsp;pop__](util-Queue-pop.md) | Pop a value off of this stackable instance |
| [__Queue&nbsp;::&nbsp;peak__](util-Queue-peak.md) | Returns the current value in the stack |
| [__Queue&nbsp;::&nbsp;\_\_construct__](util-Queue-__construct.md) |  |
| [__Queue&nbsp;::&nbsp;clear__](util-Queue-clear.md) |  |
| [__Queue&nbsp;::&nbsp;length__](util-Queue-length.md) | Get the current length of the collection |
| [__Queue&nbsp;::&nbsp;toArray__](util-Queue-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__~Queue&nbsp;::&nbsp;get~__](util-Queue-get.md) | Returns the current value in the stack |
| [__Queue&nbsp;::&nbsp;equals__](util-Queue-equals.md) | Compare an object against this instance |
| [__Queue&nbsp;::&nbsp;traverse__](util-Queue-traverse.md) | Traverses the dataset |
| [__~Queue&nbsp;::&nbsp;copy~__](util-Queue-copy.md) | Clone this instance and return it |
| [__Queue&nbsp;::&nbsp;combineArrays__](util-Queue-combineArrays.md) | Combine two arrays recursively  This is similar to `array_merge_recursive()`, but this method does not alter the structure |
| [__~Queue&nbsp;::&nbsp;lock~__](util-Queue-lock.md) | Lock the dataset to make it immutable |
| [__Queue&nbsp;::&nbsp;clone__](util-Queue-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
