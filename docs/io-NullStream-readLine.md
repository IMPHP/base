# [I/O](io.md) / [NullStream](io-NullStream.md) :: readLine
 > im\io\NullStream
____

## Description
Read a line from the stream.

Careful, if the stream has no line endings,
this may read a very large ammount of data into memory.
The read does not stop until a line ending or EOF
has been reached, unless `$maxlen` has been defined.

## Synopsis
```php
public readLine(int $maxlen = -1): null|string
```

## Parameters
| Name | Description |
| :--- | :---------- |
| maxlen | Max bytes to read before stop, regardless of line endings. |

## Return
The bytes that was read or empty string '' on EOF.
On error a `NULL` value is returned.
