# [I/O](io.md) / [RawStream](io-RawStream.md) :: truncate
 > im\io\RawStream
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
