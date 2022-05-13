# [Base](base.md) / [I/O](io.md) / StreamWrapper
 > im\io\StreamWrapper
____

## Description
Stream wrapper that is used to convert a Stream
into a valid PHP resource.

Do not create instances of this class.
It's unofficially part of a StreamWrapper Interface,
that does not exist, and is used internaly by PHP.

You can use `StreamWrapper::getResource()` to get a
resource that is using a Stream underneath. You can also
just use `Stream::getResource()`.

## Synopsis
```php
class StreamWrapper {

    // Constants
    public string NAME = 'imphp'

    // Methods
    public static getResource(im\io\Stream $stream, bool $noClose = TRUE): resource
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__StreamWrapper&nbsp;::&nbsp;NAME__](io-StreamWrapper-prop_NAME.md) | The stream wrapper name that is registered to the system |

## Methods
| Name | Description |
| :--- | :---------- |
| [__StreamWrapper&nbsp;::&nbsp;getResource__](io-StreamWrapper-getResource.md) | Convert a Stream into a valid PHP Resource |
