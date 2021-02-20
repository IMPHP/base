# [Base](base.md) / I/O
____

## Description
Small IO package that is bundled with IMPHP Base.

## Classes
| Name | Description |
| :--- | :---------- |
| [Stream](io-Stream.md) | Defines a stream resource that can be written and/or read from |
| [RawStream](io-RawStream.md) | A stream implementation that wrappes a PHP `resource` |
| [FileStream](io-FileStream.md) | A stream implementation that can lazyly open files |
| [NullStream](io-NullStream.md) | A stream implementation that reads and writes to `NULL` |
| [StreamWrapper](io-StreamWrapper.md) | Stream wrapper that is used to convert a Stream into a valid PHP resource |
| [StreamDecorator](io-StreamDecorator.md) | Provides implementation for `im\io\Stream` |
