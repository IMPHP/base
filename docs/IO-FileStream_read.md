# [IO](IO.md) / [FileStream](IO-FileStream.md) :: read
 > im\io\FileStream
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
