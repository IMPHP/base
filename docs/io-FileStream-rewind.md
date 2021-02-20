# [I/O](io.md) / [FileStream](io-FileStream.md) :: rewind
 > im\io\FileStream
____

## Description
Rewind the pointer to point at the begining of the stream.

 > This is the same as `$this->seek(0)`.  

## Synopsis
```php
public rewind(): bool
```

## Return
It may fail and return `false` if the stream is not seekable.
