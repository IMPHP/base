# [I/O](io.md) / [CompressionStream](io-CompressionStream.md) :: read
 > im\io\CompressionStream
____

## Description
Read `$length` bytes from the stream.

## Synopsis
```php
read(int $length): null|string
```

## Parameters
| Name | Description |
| :--- | :---------- |
| length | Number of bytes to read. |

## Return
The bytes that was read or `NULL` on EOF.
