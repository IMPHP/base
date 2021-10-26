# [I/O](io.md) / [CompressionStream](io-CompressionStream.md) :: getResource
 > im\io\CompressionStream
____

## Description
Returns the StreamWrapper for this object

The php resource returned here is mearly an abstraction
allowing you to use this object on php functions requiring
a php resource. Any actions performed on the StreamWrapper
is performed on this object through the wrapper.
This includes calling `fclose()`.

## Synopsis
```php
getResource(): resource
```

## Return
A PHP `resource` that uses this stream via the stream wrapper.
