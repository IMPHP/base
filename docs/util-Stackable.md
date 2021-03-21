# [Base](base.md) / [Utilities](util.md) / Stackable
 > im\util\Stackable
____

## Description
Defines a basic stackable class.
The order of in and out is not defined in this class,
and is decided by the class extending this. This class only
defines the basic methods for any stackable class and a few
pre-build collection methods.

## Synopsis
```php
abstract class Stackable implements im\util\Collection, Traversable, IteratorAggregate {

    // Methods
    abstract public push(mixed $value): void
    abstract public pop(): mixed
    abstract public get(): mixed
    public __construct()
    public toArray(): array
    public equals(object $other): bool

    // Inherited Methods
    abstract public clear(): void
    abstract public length(): int
    abstract public copy(null|callable $sort = NULL): static
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__Stackable&nbsp;::&nbsp;push__](util-Stackable-push.md) | Push a new value into this stackable instance |
| [__Stackable&nbsp;::&nbsp;pop__](util-Stackable-pop.md) | Pop a value off of this stackable instance |
| [__Stackable&nbsp;::&nbsp;get__](util-Stackable-get.md) | Returns the current value in the stack |
| [__Stackable&nbsp;::&nbsp;\_\_construct__](util-Stackable-__construct.md) |  |
| [__Stackable&nbsp;::&nbsp;toArray__](util-Stackable-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__Stackable&nbsp;::&nbsp;equals__](util-Stackable-equals.md) | Compare an object against this instance |
| [__Stackable&nbsp;::&nbsp;clear__](util-Stackable-clear.md) | Clear the collection |
| [__Stackable&nbsp;::&nbsp;length__](util-Stackable-length.md) | Get the current length of the collection |
| [__Stackable&nbsp;::&nbsp;copy__](util-Stackable-copy.md) | Clone this instance and return it |
