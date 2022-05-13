# [I/O](io.md) / [NullStream](io-NullStream.md) :: clear
 > im\io\NullStream
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
