# [Utilities](util.md) / [Stackable](util-Stackable.md) :: pop
 > im\util\Stackable
____

## Description
Pop a value off of this stackable instance.
The order in which values are removed, depends on
the implementation.

## Synopsis
```php
abstract public pop(): mixed
```

## Return
This will return the value that was popped off the stack.
If this stack is empty, then `NULL` is returned.
