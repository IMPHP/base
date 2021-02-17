# [IO](IO.md) / [Stream](IO-Stream.md) :: writeFromStream
 > im\io\Stream
____

## Description
Write data from another stream into this one.

Data will be read from the current offset of the source stream
and written to the current offset of the target. Any data
following the target offset will be overridden.

## Synopsis
```php
writeFromStream(im\io\Stream $stream): int
```

## Parameters
| Name | Description |
| :--- | :---------- |
| stream | The source strem to read from. |

## Return
Returns the number of bytes written or `-1` if it failed.
