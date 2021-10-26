# [Base](base.md) / I/O
____

## Description
Small IO package that is bundled with IMPHP Base.

## Interfaces
| Name | Description |
| :--- | :---------- |
| [Stream](io-Stream.md) | Defines a stream resource that can be written and/or read from |
| [CompressionStream](io-CompressionStream.md) | Defines a stream resource with compression features |

## Traits
| Name | Description |
| :--- | :---------- |
| [StreamDecorator](io-StreamDecorator.md) | Provides implementation for `im\io\Stream` |

## Classes
| Name | Description |
| :--- | :---------- |
| [RawStream](io-RawStream.md) | A stream implementation that wrappes a PHP `resource` |
| [FileStream](io-FileStream.md) | A stream implementation that can lazyly open files |
| [NullStream](io-NullStream.md) | A stream implementation that reads and writes to `NULL` |
| [StreamWrapper](io-StreamWrapper.md) | Stream wrapper that is used to convert a Stream into a valid PHP resource |
| [GZipStream](io-GZipStream.md) | A CompressionStream that is backed by GZip DEFLATE  This stream will compress and decompress all data that is read from and written to the backing stream |
| [CompressionHeader](io-CompressionHeader.md) | Internal helper class for `im\io\CompressionStream` implementations |
