# [I/O](io.md) / [StreamWrapper](io-StreamWrapper.md) :: getResource
 > im\io\StreamWrapper
____

## Description
Convert a Stream into a valid PHP Resource.

## Synopsis
```php
public static getResource(im\io\Stream $stream, bool $noClose = TRUE): resource
```

## Parameters
| Name | Description |
| :--- | :---------- |
| stream | The stream to convert. |
| noClose | Disable `fclose` to avoid PHP auto closing streams<br />during function/method scope change. |

## Return
A PHP resource wrapper.
