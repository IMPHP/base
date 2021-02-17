# [Base](Base.md) / [IO](IO.md) / FileStream
 > im\io\FileStream
____

## Description
A stream implementation that can lazyly open files.

This is mostly the same as `RawStream`. The differences are:

 - You don't have to manually create a resource and parse it to the stream.
 - It has the option to lazily open the path when/if it's needed.

## Synopsis
```php
class FileStream uses im\io\res\StreamDecorator implements im\io\Stream {

    // Constants
    const string DEF_MODE = r+
    const int F_READABLE = 0b100
    const int F_WRITABLE = 0b1000
    const int F_SEEKABLE = 0b10000
    const int F_RW = 0b1100
    const int F_RS = 0b10100
    const int F_WS = 0b11000
    const int F_RWS = 0b11100

    // Methods
    __construct(string $file, string $mode = Stream::DEF_MODE, bool $lazy = false): mixed
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
    getMetadata(): im\util\MapArray
    close(): void
    toString(): string
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__FileStream&nbsp;::&nbsp;DEF\_MODE__](IO-FileStream_DEF_MODE.md) | Default mode that is used when nothing else is defined |
| [__FileStream&nbsp;::&nbsp;F\_READABLE__](IO-FileStream_F_READABLE.md) | Stream is readable |
| [__FileStream&nbsp;::&nbsp;F\_WRITABLE__](IO-FileStream_F_WRITABLE.md) | Stream is writable |
| [__FileStream&nbsp;::&nbsp;F\_SEEKABLE__](IO-FileStream_F_SEEKABLE.md) | Stream is seekable |
| [__FileStream&nbsp;::&nbsp;F\_RW__](IO-FileStream_F_RW.md) | Stream is readable and writable (Multi bit) |
| [__FileStream&nbsp;::&nbsp;F\_RS__](IO-FileStream_F_RS.md) | Stream is readable and seekable (Multi bit) |
| [__FileStream&nbsp;::&nbsp;F\_WS__](IO-FileStream_F_WS.md) | Stream is writable and seekable (Multi bit) |
| [__FileStream&nbsp;::&nbsp;F\_RWS__](IO-FileStream_F_RWS.md) | Stream is readable, writable and seekable (Multi bit) |

## Methods
| Name | Description |
| :--- | :---------- |
| [__FileStream&nbsp;::&nbsp;\_\_construct__](IO-FileStream___construct.md) |  |
| [__FileStream&nbsp;::&nbsp;getResource__](IO-FileStream_getResource.md) | Returns the StreamWrapper for this object |
| [__FileStream&nbsp;::&nbsp;getFlags__](IO-FileStream_getFlags.md) | Return the status flags for the current resource. |
| [__FileStream&nbsp;::&nbsp;getMode__](IO-FileStream_getMode.md) | Returns the mode used by this stream |
| [__FileStream&nbsp;::&nbsp;isWritable__](IO-FileStream_isWritable.md) | Check if the stream is writable |
| [__FileStream&nbsp;::&nbsp;isReadable__](IO-FileStream_isReadable.md) | Check if the stream is readable |
| [__FileStream&nbsp;::&nbsp;isSeekable__](IO-FileStream_isSeekable.md) | Check if the stream is seekable |
| [__FileStream&nbsp;::&nbsp;getLength__](IO-FileStream_getLength.md) | Get the current length of the stream content |
| [__FileStream&nbsp;::&nbsp;getOffset__](IO-FileStream_getOffset.md) | Get the current stream offset |
| [__FileStream&nbsp;::&nbsp;isEOF__](IO-FileStream_isEOF.md) | Check whether the stream is at the end |
| [__FileStream&nbsp;::&nbsp;seek__](IO-FileStream_seek.md) | Position the pointer at a different offset in the stream. |
| [__FileStream&nbsp;::&nbsp;rewind__](IO-FileStream_rewind.md) | Rewind the pointer to point at the begining of the stream |
| [__FileStream&nbsp;::&nbsp;writeFromStream__](IO-FileStream_writeFromStream.md) | Write data from another stream into this one. |
| [__FileStream&nbsp;::&nbsp;write__](IO-FileStream_write.md) | Write data to the stream |
| [__FileStream&nbsp;::&nbsp;read__](IO-FileStream_read.md) | Read `$length` bytes from the stream |
| [__FileStream&nbsp;::&nbsp;readLine__](IO-FileStream_readLine.md) | Read a line from the stream. |
| [__FileStream&nbsp;::&nbsp;clear__](IO-FileStream_clear.md) | Clear the entire stream |
| [__FileStream&nbsp;::&nbsp;truncate__](IO-FileStream_truncate.md) | Truncates a file to `$size` length |
| [__FileStream&nbsp;::&nbsp;getMetadata__](IO-FileStream_getMetadata.md) | Get the metadata for the underlaying resource. |
| [__FileStream&nbsp;::&nbsp;close__](IO-FileStream_close.md) | Close the underlaying resource |
| [__FileStream&nbsp;::&nbsp;toString__](IO-FileStream_toString.md) | Read and return the entire stream content |

## Example 1
```php
$stream = new FileStream($path, '+r', true);

foreach (($line = $stream->readLine()) !== null) { // File is opened here
    printf("%s\n", $line);
}

$stream->close();
```
