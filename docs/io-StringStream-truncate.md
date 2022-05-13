# [I/O](io.md) / [StringStream](io-StringStream.md) :: truncate
 > im\io\StringStream
____

## Description
Truncates a file to `$size` length.

## Synopsis
```php
public truncate(int $size): bool
```

## Parameters
| Name | Description |
| :--- | :---------- |
| size | Length to truncate to. |

## Return
It may fail and return `false` if the stream is not
writable or seekable.
