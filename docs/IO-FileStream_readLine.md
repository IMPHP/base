# [IO](IO.md) / [FileStream](IO-FileStream.md) :: readLine
 > im\io\FileStream
____

## Description
Read a line from the stream.

Careful, if the stream has no line endings,
this may read a very large ammount of data into memory.
The read does not stop until a line ending or EOF
has been reached, unless `$maxlen` has been defined.

## Synopsis
```php
readLine(int $maxlen = -1): ?string
```

## Parameters
| Name | Description |
| :--- | :---------- |
| maxlen | Max bytes to read before stop, regardless of line endings. |

## Return
The bytes that was read or `NULL` on EOF.
