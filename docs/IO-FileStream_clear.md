# [IO](IO.md) / [FileStream](IO-FileStream.md) :: clear
 > im\io\FileStream
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
