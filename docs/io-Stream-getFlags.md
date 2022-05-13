# [I/O](io.md) / [Stream](io-Stream.md) :: getFlags
 > im\io\Stream
____

## Description
Return the status flags for the current resource.

You can use the `Stream::F_` constants to sort
out the different bits and their meaning.

## Synopsis
```php
getFlags(int $mask = 0): int
```

## Parameters
| Name | Description |
| :--- | :---------- |
| mask | Mask to sort the flags before returning them |
