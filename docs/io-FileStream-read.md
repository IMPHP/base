# [I/O](io.md) / [FileStream](io-FileStream.md) :: read
 > im\io\FileStream
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
