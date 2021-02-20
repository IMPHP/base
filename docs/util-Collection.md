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
interface Collection implements IteratorAggregate, Traversable {

    // Methods
    clear(): void
    length(): int
    toArray(): array
    copy(null|callable $sort = NULL): static
    equals(object $other): bool

    // Inherited Methods
    getIterator()
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__Collection&nbsp;::&nbsp;clear__](util-Collection-clear.md) | Clear the collection |
| [__Collection&nbsp;::&nbsp;length__](util-Collection-length.md) | Get the current length of the collection |
| [__Collection&nbsp;::&nbsp;toArray__](util-Collection-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__Collection&nbsp;::&nbsp;copy__](util-Collection-copy.md) | Clone this instance and return it |
| [__Collection&nbsp;::&nbsp;equals__](util-Collection-equals.md) | Compare an object against this instance |
| [__Collection&nbsp;::&nbsp;getIterator__](util-Collection-getIterator.md) |  |
