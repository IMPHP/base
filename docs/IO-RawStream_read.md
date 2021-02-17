# [IO](IO.md) / [RawStream](IO-RawStream.md) :: read
 > im\io\RawStream
____

## Description
Read `$length` bytes from the stream.

## Synopsis
```php
read(int $length): ?string
```

## Parameters
| Name | Description |
| :--- | :---------- |
| length | Number of bytes to read. |

## Return
The bytes that was read or `NULL` on EOF.
