# [Base](base.md) / [Utilities](util.md) / Collection
 > im\util\Collection
____

## Description
Defines a base collection interface.

Arrays in PHP is a great internal tool because of their flexibility.
However they are not that great as parameters and return types for
this exact reason. It's dificult to keep track of their actual
content and their structure. Strict collection classes makes this
much easier when you can distinguish between a list or a map for example.

## Synopsis
```php
interface Collection implements IteratorAggregate, im\features\Serializable, im\features\Cloneable, Traversable {

    // Methods
    length(): int
    toArray(): array
    copy(null|callable $sort = NULL): static
    equals(object $other): bool
    traverse(callable $func): bool

    // Inherited Methods
    getIterator()
    __serialize(): array
    __unserialize(array $data): void
    __debugInfo(): array
    clone(): static
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__Collection&nbsp;::&nbsp;length__](util-Collection-length.md) | Get the current length of the collection |
| [__Collection&nbsp;::&nbsp;toArray__](util-Collection-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__~Collection&nbsp;::&nbsp;copy~__](util-Collection-copy.md) | Clone this instance and return it |
| [__Collection&nbsp;::&nbsp;equals__](util-Collection-equals.md) | Compare an object against this instance |
| [__Collection&nbsp;::&nbsp;traverse__](util-Collection-traverse.md) | Traverses the dataset |
| [__Collection&nbsp;::&nbsp;getIterator__](util-Collection-getIterator.md) |  |
| [__Collection&nbsp;::&nbsp;\_\_serialize__](util-Collection-__serialize.md) |  |
| [__Collection&nbsp;::&nbsp;\_\_unserialize__](util-Collection-__unserialize.md) |  |
| [__Collection&nbsp;::&nbsp;\_\_debugInfo__](util-Collection-__debugInfo.md) |  |
| [__Collection&nbsp;::&nbsp;clone__](util-Collection-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
