# [IO](IO.md) / [Stream](IO-Stream.md) :: truncate
 > im\io\Stream
____

## Description
Truncates a file to `$size` length.

## Synopsis
```php
truncate(int $size): bool
```

## Parameters
| Name | Description |
| :--- | :---------- |
| size | Length to truncate to. |

## Return
It may fail and return `false` if the stream is not
writable or seekable.
