# [Base](Base.md) / [IO](IO.md) / StreamDecorator
 > im\io\res\StreamDecorator
____

## Description
Provides implementation for `im\io\Stream`.

This can be used to easily create abstractions for `Stream` objects.
It provides all the implementation from `im\io\Stream` and redirects it to
an underlaying `im\io\Stream` instance via `$this->stream`.

## Synopsis
```php
trait StreamDecorator {

    // Properties
    im\io\Stream $stream

    // Methods
    getResource(): mixed
    getFlags(): int
    getMode(): ?string
    isWritable(): bool
    isReadable(): bool
    isSeekable(): bool
    getLength(): int
    getOffset(): int
    isEOF(): bool
    seek(int $offset, int $whence = SEEK_SET): bool
    rewind(): bool
    writeFromStream(im\io\Stream $stream): int
    write(string $string, bool $expand = false): int
    read(int $length): ?string
    readLine(int $maxlen = -1): ?string
    clear(): bool
    truncate(int $size): bool
    getMetadata(): im\util\Map
    close(): void
    toString(): string
}
```

## Properties
| Name | Description |
| :--- | :---------- |
| StreamDecorator&nbsp;::&nbsp;stream | Property used by this Trait to access the underlaying `Stream`. This is just a reference property and not really defined within this trait. How this is implemented is up to the implementing class. |

## Methods
| Name | Description |
| :--- | :---------- |
| [__StreamDecorator&nbsp;::&nbsp;getResource__](IO-StreamDecorator_getResource.md) |  |
| [__StreamDecorator&nbsp;::&nbsp;getFlags__](IO-StreamDecorator_getFlags.md) |  |
| [__StreamDecorator&nbsp;::&nbsp;getMode__](IO-StreamDecorator_getMode.md) |  |
| [__StreamDecorator&nbsp;::&nbsp;isWritable__](IO-StreamDecorator_isWritable.md) |  |
| [__StreamDecorator&nbsp;::&nbsp;isReadable__](IO-StreamDecorator_isReadable.md) |  |
| [__StreamDecorator&nbsp;::&nbsp;isSeekable__](IO-StreamDecorator_isSeekable.md) |  |
| [__StreamDecorator&nbsp;::&nbsp;getLength__](IO-StreamDecorator_getLength.md) |  |
| [__StreamDecorator&nbsp;::&nbsp;getOffset__](IO-StreamDecorator_getOffset.md) |  |
| [__StreamDecorator&nbsp;::&nbsp;isEOF__](IO-StreamDecorator_isEOF.md) |  |
| [__StreamDecorator&nbsp;::&nbsp;seek__](IO-StreamDecorator_seek.md) |  |
| [__StreamDecorator&nbsp;::&nbsp;rewind__](IO-StreamDecorator_rewind.md) |  |
| [__StreamDecorator&nbsp;::&nbsp;writeFromStream__](IO-StreamDecorator_writeFromStream.md) |  |
| [__StreamDecorator&nbsp;::&nbsp;write__](IO-StreamDecorator_write.md) |  |
| [__StreamDecorator&nbsp;::&nbsp;read__](IO-StreamDecorator_read.md) |  |
| [__StreamDecorator&nbsp;::&nbsp;readLine__](IO-StreamDecorator_readLine.md) |  |
| [__StreamDecorator&nbsp;::&nbsp;clear__](IO-StreamDecorator_clear.md) |  |
| [__StreamDecorator&nbsp;::&nbsp;truncate__](IO-StreamDecorator_truncate.md) |  |
| [__StreamDecorator&nbsp;::&nbsp;getMetadata__](IO-StreamDecorator_getMetadata.md) |  |
| [__StreamDecorator&nbsp;::&nbsp;close__](IO-StreamDecorator_close.md) |  |
| [__StreamDecorator&nbsp;::&nbsp;toString__](IO-StreamDecorator_toString.md) |  |

## Example 1
```php
class MyStream implements Stream {
    use StreamDecorator;

    public function __construct(Stream $stream) {
        $this->stream = $stream;
    }

    public function write(string $string, bool $expand = false): int {
        // Extend and change the behavior of this particular method
    }
}
```
