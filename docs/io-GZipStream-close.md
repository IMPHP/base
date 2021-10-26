# [I/O](io.md) / [GZipStream](io-GZipStream.md) :: close
 > im\io\GZipStream
____

## Description
Close this stream.

 > Remaining headers such as the uncompressed data length will be written to the stream before closing it. Failing to call this method before destructing the instance will result in some header loss.  

## Synopsis
```php
public close(bool $keepAlive = FALSE): void
```

## Parameters
| Name | Description |
| :--- | :---------- |
| keepAlive | Only write headers to stream and finalize this instance.<br />Do not close the backing stream. |
