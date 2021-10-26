# [I/O](io.md) / [GZipStream](io-GZipStream.md) :: __construct
 > im\io\GZipStream
____

## Description
Create a new instance of GZipStream.

 > The backing `Stream` must be either readable or writable. It cannot be both.  

 > When adding a writable `Stream`, it will be truncated.  

## Synopsis
```php
public __construct(im\io\Stream $stream)
```

## Parameters
| Name | Description |
| :--- | :---------- |
| stream | The backing stream to write to or read from. |
