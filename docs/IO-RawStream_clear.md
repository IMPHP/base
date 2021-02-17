# [IO](IO.md) / [RawStream](IO-RawStream.md) :: clear
 > im\io\RawStream
____

## Description
Clear the entire stream.

    This is the same as `$this->truncate(0)`  

## Synopsis
```php
clear(): bool
```

## Return
It may fail and return `false` if the stream is not
writable or seekable.
