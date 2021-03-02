# [Base](base.md) / [Utilities](util.md) / Queue
 > im\util\Queue
____

## Description
This stack-able pushes values to the top while
popping them from the bottom.

 > The iterator in this class will pop all returned values. This means that you can simply iterate through the queue to pop them in the correct order. It also means that you will loop forever if you push values during iteration.  

## Synopsis
```php
class Queue extends im\util\Stackable implements IteratorAggregate, Traversable, im\util\Collection {

    // Methods
    public __construct(int $capacity = 0)
    public push(mixed $value): void
    public pop(): mixed
    public clear(): void
    public length(): int
    public toArray(): array
    public copy(null|callable $sort = NULL): static

    // Inherited Methods
    public equals(object $other): bool
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__Queue&nbsp;::&nbsp;\_\_construct__](util-Queue-__construct.md) |  |
| [__Queue&nbsp;::&nbsp;push__](util-Queue-push.md) | Push a new value into this stackable instance |
| [__Queue&nbsp;::&nbsp;pop__](util-Queue-pop.md) | Pop a value off of this stackable instance |
| [__Queue&nbsp;::&nbsp;clear__](util-Queue-clear.md) | Clear the collection |
| [__Queue&nbsp;::&nbsp;length__](util-Queue-length.md) | Get the current length of the collection |
| [__Queue&nbsp;::&nbsp;toArray__](util-Queue-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__Queue&nbsp;::&nbsp;copy__](util-Queue-copy.md) | Clone this instance and return it |
| [__Queue&nbsp;::&nbsp;equals__](util-Queue-equals.md) | Compare an object against this instance |
