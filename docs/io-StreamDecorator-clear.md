# [I/O](io.md) / [StreamDecorator](io-StreamDecorator.md) :: clear
 > im\io\res\StreamDecorator
____

## Description
Clear the entire stream.

 > This is the same as `$this->truncate(0)`  

## Synopsis
```php
public clear(): bool
```

## Return
It may fail and return `false` if the stream is not
writable or seekable.
