# [Base](Base.md) / [IO](IO.md) / StreamWrapper
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
    const string NAME = imphp

    // Methods
    static getResource(im\io\Stream $stream): mixed
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__StreamWrapper&nbsp;::&nbsp;NAME__](IO-StreamWrapper_NAME.md) | The stream wrapper name that is registered to the system |

## Methods
| Name | Description |
| :--- | :---------- |
| [__StreamWrapper&nbsp;::&nbsp;getResource__](IO-StreamWrapper_getResource.md) | Convert a Stream into a valid PHP Resource |
