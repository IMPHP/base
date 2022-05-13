# [I/O](io.md) / [StringStream](io-StringStream.md) :: rewind
 > im\io\StringStream
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
