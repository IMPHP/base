# [I/O](io.md) / [NullStream](io-NullStream.md) :: read
 > im\io\NullStream
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
The bytes that was read or empty string '' on EOF.
On error a `NULL` value is returned.
