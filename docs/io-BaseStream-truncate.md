# [I/O](io.md) / [BaseStream](io-BaseStream.md) :: truncate
 > im\io\BaseStream
____

## Description
Truncates a file to `$size` length.

## Synopsis
```php
abstract public truncate(int $size): bool
```

## Parameters
| Name | Description |
| :--- | :---------- |
| size | Length to truncate to. |

## Return
It may fail and return `false` if the stream is not
writable or seekable.
