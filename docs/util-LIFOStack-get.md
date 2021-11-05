# [Utilities](util.md) / [LIFOStack](util-LIFOStack.md) :: get
 > im\util\LIFOStack
____

## Description
Returns the current value in the stack.

The value that is returned from this, is the next value
that will be popped of when calling `pop()`.

> :warning: **Deprecated**  
> This method has been replaced by `peak()`  

## Synopsis
```php
public get(): mixed
```

## Return
If this stack is empty, then `NULL` is returned.
