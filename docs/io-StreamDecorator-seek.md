# [I/O](io.md) / [StreamDecorator](io-StreamDecorator.md) :: seek
 > im\io\res\StreamDecorator
____

## Description
Position the pointer at a different offset in the stream.
Any new reads or writes will be performed from this offset in the stream.

 > Any writes may override existing data below this offset.  

## Synopsis
```php
public seek(int $offset, int $whence = SEEK_SET): bool
```

## Parameters
| Name | Description |
| :--- | :---------- |
| offset | A new offset for the pointer. |
| whence | `https://secure.php.net/manual/en/function.fseek.php` |

## Return
It may fail and return `false` if the stream is not seekable.
