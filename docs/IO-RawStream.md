# [Base](Base.md) / [IO](IO.md) / RawStream
 > im\io\RawStream
____

## Description
A stream implementation that wrappes a PHP `resource`.

## Synopsis
```php
class RawStream implements im\io\Stream {

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
    __construct(mixed $res = null): mixed
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
    close(): void
    getMetadata(): im\util\MapArray
    toString(): string
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__RawStream&nbsp;::&nbsp;DEF\_MODE__](IO-RawStream_DEF_MODE.md) | Default mode that is used when nothing else is defined |
| [__RawStream&nbsp;::&nbsp;F\_READABLE__](IO-RawStream_F_READABLE.md) | Stream is readable |
| [__RawStream&nbsp;::&nbsp;F\_WRITABLE__](IO-RawStream_F_WRITABLE.md) | Stream is writable |
| [__RawStream&nbsp;::&nbsp;F\_SEEKABLE__](IO-RawStream_F_SEEKABLE.md) | Stream is seekable |
| [__RawStream&nbsp;::&nbsp;F\_RW__](IO-RawStream_F_RW.md) | Stream is readable and writable (Multi bit) |
| [__RawStream&nbsp;::&nbsp;F\_RS__](IO-RawStream_F_RS.md) | Stream is readable and seekable (Multi bit) |
| [__RawStream&nbsp;::&nbsp;F\_WS__](IO-RawStream_F_WS.md) | Stream is writable and seekable (Multi bit) |
| [__RawStream&nbsp;::&nbsp;F\_RWS__](IO-RawStream_F_RWS.md) | Stream is readable, writable and seekable (Multi bit) |

## Methods
| Name | Description |
| :--- | :---------- |
| [__RawStream&nbsp;::&nbsp;\_\_construct__](IO-RawStream___construct.md) |  |
| [__RawStream&nbsp;::&nbsp;getResource__](IO-RawStream_getResource.md) | Returns the StreamWrapper for this object |
| [__RawStream&nbsp;::&nbsp;getFlags__](IO-RawStream_getFlags.md) | Return the status flags for the current resource. |
| [__RawStream&nbsp;::&nbsp;getMode__](IO-RawStream_getMode.md) | Returns the mode used by this stream |
| [__RawStream&nbsp;::&nbsp;isWritable__](IO-RawStream_isWritable.md) | Check if the stream is writable |
| [__RawStream&nbsp;::&nbsp;isReadable__](IO-RawStream_isReadable.md) | Check if the stream is readable |
| [__RawStream&nbsp;::&nbsp;isSeekable__](IO-RawStream_isSeekable.md) | Check if the stream is seekable |
| [__RawStream&nbsp;::&nbsp;getLength__](IO-RawStream_getLength.md) | Get the current length of the stream content |
| [__RawStream&nbsp;::&nbsp;getOffset__](IO-RawStream_getOffset.md) | Get the current stream offset |
| [__RawStream&nbsp;::&nbsp;isEOF__](IO-RawStream_isEOF.md) | Check whether the stream is at the end |
| [__RawStream&nbsp;::&nbsp;seek__](IO-RawStream_seek.md) | Position the pointer at a different offset in the stream. |
| [__RawStream&nbsp;::&nbsp;rewind__](IO-RawStream_rewind.md) | Rewind the pointer to point at the begining of the stream |
| [__RawStream&nbsp;::&nbsp;writeFromStream__](IO-RawStream_writeFromStream.md) | Write data from another stream into this one. |
| [__RawStream&nbsp;::&nbsp;write__](IO-RawStream_write.md) | Write data to the stream |
| [__RawStream&nbsp;::&nbsp;read__](IO-RawStream_read.md) | Read `$length` bytes from the stream |
| [__RawStream&nbsp;::&nbsp;readLine__](IO-RawStream_readLine.md) | Read a line from the stream. |
| [__RawStream&nbsp;::&nbsp;clear__](IO-RawStream_clear.md) | Clear the entire stream |
| [__RawStream&nbsp;::&nbsp;truncate__](IO-RawStream_truncate.md) | Truncates a file to `$size` length |
| [__RawStream&nbsp;::&nbsp;close__](IO-RawStream_close.md) | Close the underlaying resource |
| [__RawStream&nbsp;::&nbsp;getMetadata__](IO-RawStream_getMetadata.md) | Get the metadata for the underlaying resource. |
| [__RawStream&nbsp;::&nbsp;toString__](IO-RawStream_toString.md) | Read and return the entire stream content |

## Example 1
```php
$stream = new RawStream( fopen($path, 'r+') );

foreach (($line = $stream->readLine()) !== null) {
    printf("%s\n", $line);
}

$stream->close();
```
