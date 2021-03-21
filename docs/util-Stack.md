# [Base](base.md) / [Utilities](util.md) / Stack
 > im\util\Stack
____

## Description
This stack-able pushes values to the top while
also popping them from the top.

 > The iterator in this class will pop all returned values. This means that you can simply iterate through the stack to pop them in the correct order. It also means that you will loop forever if you push values during iteration.  

## Synopsis
```php
class Stack extends im\util\Stackable implements IteratorAggregate, Traversable, im\util\Collection {

    // Methods
    public push(mixed $value): void
    public pop(): mixed
    public get(): mixed
    public copy(null|callable $sort = NULL): static
    public clear(): void
    public length(): int

    // Inherited Methods
    public __construct()
    public toArray(): array
    public equals(object $other): bool
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__Stack&nbsp;::&nbsp;push__](util-Stack-push.md) | Push a new value into this stackable instance |
| [__Stack&nbsp;::&nbsp;pop__](util-Stack-pop.md) | Pop a value off of this stackable instance |
| [__Stack&nbsp;::&nbsp;get__](util-Stack-get.md) | Returns the current value in the stack |
| [__Stack&nbsp;::&nbsp;copy__](util-Stack-copy.md) | Clone this instance and return it |
| [__Stack&nbsp;::&nbsp;clear__](util-Stack-clear.md) | Clear the collection |
| [__Stack&nbsp;::&nbsp;length__](util-Stack-length.md) | Get the current length of the collection |
| [__Stack&nbsp;::&nbsp;\_\_construct__](util-Stack-__construct.md) |  |
| [__Stack&nbsp;::&nbsp;toArray__](util-Stack-toArray.md) | Builds a PHP array containing all of the current values within the collection |
| [__Stack&nbsp;::&nbsp;equals__](util-Stack-equals.md) | Compare an object against this instance |
