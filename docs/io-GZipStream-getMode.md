# [I/O](io.md) / [GZipStream](io-GZipStream.md) :: getMode
 > im\io\GZipStream
____

## Description
Returns the mode used by this stream

This is a string representation of the modes
used to open the stream. You can use `::getFlags()`
instead to check for things like readability and such or use the
dedicated methods `::isWritable()`, `::isReadable()` and `::isSeekable()`.

## Synopsis
```php
public getMode(): null|string
```

## Return
Returns NULL if this for some reason is not available.
