# [IO](IO.md) / [RawStream](IO-RawStream.md) :: rewind
 > im\io\RawStream
____

## Description
Rewind the pointer to point at the begining of the stream.

    This is the same as `$this->seek(0)`.  

## Synopsis
```php
rewind(): bool
```

## Return
It may fail and return `false` if the stream is not seekable.
