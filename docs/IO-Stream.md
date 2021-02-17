# [Base](Base.md) / [IO](IO.md) / Stream
 > im\io\Stream
____

## Description
Defines a stream resource that can be written and/or read from.

## Synopsis
```php
interface Stream {

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
| [__Stream&nbsp;::&nbsp;DEF\_MODE__](IO-Stream_DEF_MODE.md) | Default mode that is used when nothing else is defined |
| [__Stream&nbsp;::&nbsp;F\_READABLE__](IO-Stream_F_READABLE.md) | Stream is readable |
| [__Stream&nbsp;::&nbsp;F\_WRITABLE__](IO-Stream_F_WRITABLE.md) | Stream is writable |
| [__Stream&nbsp;::&nbsp;F\_SEEKABLE__](IO-Stream_F_SEEKABLE.md) | Stream is seekable |
| [__Stream&nbsp;::&nbsp;F\_RW__](IO-Stream_F_RW.md) | Stream is readable and writable (Multi bit) |
| [__Stream&nbsp;::&nbsp;F\_RS__](IO-Stream_F_RS.md) | Stream is readable and seekable (Multi bit) |
| [__Stream&nbsp;::&nbsp;F\_WS__](IO-Stream_F_WS.md) | Stream is writable and seekable (Multi bit) |
| [__Stream&nbsp;::&nbsp;F\_RWS__](IO-Stream_F_RWS.md) | Stream is readable, writable and seekable (Multi bit) |

## Methods
| Name | Description |
| :--- | :---------- |
| [__Stream&nbsp;::&nbsp;getResource__](IO-Stream_getResource.md) | Returns the StreamWrapper for this object |
| [__Stream&nbsp;::&nbsp;getFlags__](IO-Stream_getFlags.md) | Return the status flags for the current resource. |
| [__Stream&nbsp;::&nbsp;getMode__](IO-Stream_getMode.md) | Returns the mode used by this stream |
| [__Stream&nbsp;::&nbsp;isWritable__](IO-Stream_isWritable.md) | Check if the stream is writable |
| [__Stream&nbsp;::&nbsp;isReadable__](IO-Stream_isReadable.md) | Check if the stream is readable |
| [__Stream&nbsp;::&nbsp;isSeekable__](IO-Stream_isSeekable.md) | Check if the stream is seekable |
| [__Stream&nbsp;::&nbsp;getLength__](IO-Stream_getLength.md) | Get the current length of the stream content |
| [__Stream&nbsp;::&nbsp;getOffset__](IO-Stream_getOffset.md) | Get the current stream offset |
| [__Stream&nbsp;::&nbsp;isEOF__](IO-Stream_isEOF.md) | Check whether the stream is at the end |
| [__Stream&nbsp;::&nbsp;seek__](IO-Stream_seek.md) | Position the pointer at a different offset in the stream. |
| [__Stream&nbsp;::&nbsp;rewind__](IO-Stream_rewind.md) | Rewind the pointer to point at the begining of the stream |
| [__Stream&nbsp;::&nbsp;writeFromStream__](IO-Stream_writeFromStream.md) | Write data from another stream into this one. |
| [__Stream&nbsp;::&nbsp;write__](IO-Stream_write.md) | Write data to the stream |
| [__Stream&nbsp;::&nbsp;read__](IO-Stream_read.md) | Read `$length` bytes from the stream |
| [__Stream&nbsp;::&nbsp;readLine__](IO-Stream_readLine.md) | Read a line from the stream. |
| [__Stream&nbsp;::&nbsp;clear__](IO-Stream_clear.md) | Clear the entire stream |
| [__Stream&nbsp;::&nbsp;truncate__](IO-Stream_truncate.md) | Truncates a file to `$size` length |
| [__Stream&nbsp;::&nbsp;getMetadata__](IO-Stream_getMetadata.md) | Get the metadata for the underlaying resource. |
| [__Stream&nbsp;::&nbsp;close__](IO-Stream_close.md) | Close the underlaying resource |
| [__Stream&nbsp;::&nbsp;toString__](IO-Stream_toString.md) | Read and return the entire stream content |
