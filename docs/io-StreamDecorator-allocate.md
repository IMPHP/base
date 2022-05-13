# [I/O](io.md) / [StreamDecorator](io-StreamDecorator.md) :: allocate
 > im\io\res\StreamDecorator
____

## Description
Allocate space at the pointer location.

This method will allocate `$length` bytes in front of the file pointer.
Any conetent after the pointer location is pushed forward, allocating
the space in between.

 > The pointer is reset to the current position after allocation.  

 > This method requires the stream to be `readable`, `writable` and `seekable`. It also does not work if the stream was opened with `a` mode.  

## Synopsis
```php
public allocate(int $length): bool
```

## Parameters
| Name | Description |
| :--- | :---------- |
| length | Length in bytes to allocate |
