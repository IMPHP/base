# [IO](IO.md) / [Stream](IO-Stream.md) :: write
 > im\io\Stream
____

## Description
Write data to the stream.

## Synopsis
```php
write(string $string, bool $expand = false): int
```

## Parameters
| Name | Description |
| :--- | :---------- |
| string | The data to write. |
| expand | If true, data that is not written at the end of the stream,<br />will expand the current content and new data will be written<br />in between. Otherwise new data will truncate existing content<br />at the current offset. Warning though, this may be a bit slower<br />operation than normal writes, depending on the stream type. |

## Return
Returns the number of bytes written or `-1` if it failed.
