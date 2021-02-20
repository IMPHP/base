# [I/O](io.md) / [StreamDecorator](io-StreamDecorator.md) :: read
 > im\io\res\StreamDecorator
____

## Description
Read `$length` bytes from the stream.

## Synopsis
```php
public read(int $length): null|string
```

## Parameters
| Name | Description |
| :--- | :---------- |
| length | Number of bytes to read. |

## Return
The bytes that was read or `NULL` on EOF.
