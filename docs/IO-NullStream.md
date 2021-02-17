# [Base](Base.md) / [IO](IO.md) / NullStream
 > im\io\NullStream
____

## Description
A stream implementation that reads and writes to `NULL`.

This is an unending stream that can be used mostly for testing purposes.
It can read bytes forever and anything written to it is disposed off, while acting as if it was written.

This can be compared to `/dev/null` and `/dev/urandom` on Linux.

## Synopsis
```php
class NullStream uses im\io\res\StreamDecorator implements im\io\Stream {

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
    __construct(string $mode = Stream::DEF_MODE): mixed
    getLength(): int
    isEOF(): bool
    getOffset(): int
    seek(int $offset, int $whence = SEEK_SET): bool
    rewind(): bool
    write(string $string, bool $expand = false): int
    read(int $length): ?string
    readLine(int $maxlen = -1): ?string
    clear(): bool
    truncate(int $size): bool
    getResource(): mixed
    getFlags(): int
    getMode(): ?string
    isWritable(): bool
    isReadable(): bool
    isSeekable(): bool
    writeFromStream(im\io\Stream $stream): int
    getMetadata(): im\util\MapArray
    close(): void
    toString(): string
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__NullStream&nbsp;::&nbsp;DEF\_MODE__](IO-NullStream_DEF_MODE.md) | Default mode that is used when nothing else is defined |
| [__NullStream&nbsp;::&nbsp;F\_READABLE__](IO-NullStream_F_READABLE.md) | Stream is readable |
| [__NullStream&nbsp;::&nbsp;F\_WRITABLE__](IO-NullStream_F_WRITABLE.md) | Stream is writable |
| [__NullStream&nbsp;::&nbsp;F\_SEEKABLE__](IO-NullStream_F_SEEKABLE.md) | Stream is seekable |
| [__NullStream&nbsp;::&nbsp;F\_RW__](IO-NullStream_F_RW.md) | Stream is readable and writable (Multi bit) |
| [__NullStream&nbsp;::&nbsp;F\_RS__](IO-NullStream_F_RS.md) | Stream is readable and seekable (Multi bit) |
| [__NullStream&nbsp;::&nbsp;F\_WS__](IO-NullStream_F_WS.md) | Stream is writable and seekable (Multi bit) |
| [__NullStream&nbsp;::&nbsp;F\_RWS__](IO-NullStream_F_RWS.md) | Stream is readable, writable and seekable (Multi bit) |

## Methods
| Name | Description |
| :--- | :---------- |
| [__NullStream&nbsp;::&nbsp;\_\_construct__](IO-NullStream___construct.md) |  |
| [__NullStream&nbsp;::&nbsp;getLength__](IO-NullStream_getLength.md) | Get the current length of the stream content |
| [__NullStream&nbsp;::&nbsp;isEOF__](IO-NullStream_isEOF.md) | Check whether the stream is at the end |
| [__NullStream&nbsp;::&nbsp;getOffset__](IO-NullStream_getOffset.md) | Get the current stream offset |
| [__NullStream&nbsp;::&nbsp;seek__](IO-NullStream_seek.md) | Position the pointer at a different offset in the stream. |
| [__NullStream&nbsp;::&nbsp;rewind__](IO-NullStream_rewind.md) | Rewind the pointer to point at the begining of the stream |
| [__NullStream&nbsp;::&nbsp;write__](IO-NullStream_write.md) | Write data to the stream |
| [__NullStream&nbsp;::&nbsp;read__](IO-NullStream_read.md) | Read `$length` bytes from the stream |
| [__NullStream&nbsp;::&nbsp;readLine__](IO-NullStream_readLine.md) | Read a line from the stream. |
| [__NullStream&nbsp;::&nbsp;clear__](IO-NullStream_clear.md) | Clear the entire stream |
| [__NullStream&nbsp;::&nbsp;truncate__](IO-NullStream_truncate.md) | Truncates a file to `$size` length |
| [__NullStream&nbsp;::&nbsp;getResource__](IO-NullStream_getResource.md) | Returns the StreamWrapper for this object |
| [__NullStream&nbsp;::&nbsp;getFlags__](IO-NullStream_getFlags.md) | Return the status flags for the current resource. |
| [__NullStream&nbsp;::&nbsp;getMode__](IO-NullStream_getMode.md) | Returns the mode used by this stream |
| [__NullStream&nbsp;::&nbsp;isWritable__](IO-NullStream_isWritable.md) | Check if the stream is writable |
| [__NullStream&nbsp;::&nbsp;isReadable__](IO-NullStream_isReadable.md) | Check if the stream is readable |
| [__NullStream&nbsp;::&nbsp;isSeekable__](IO-NullStream_isSeekable.md) | Check if the stream is seekable |
| [__NullStream&nbsp;::&nbsp;writeFromStream__](IO-NullStream_writeFromStream.md) | Write data from another stream into this one. |
| [__NullStream&nbsp;::&nbsp;getMetadata__](IO-NullStream_getMetadata.md) | Get the metadata for the underlaying resource. |
| [__NullStream&nbsp;::&nbsp;close__](IO-NullStream_close.md) | Close the underlaying resource |
| [__NullStream&nbsp;::&nbsp;toString__](IO-NullStream_toString.md) | Read and return the entire stream content |

## Example 1
```php
$stream = new NullStream('+r'); // It will adhere to these rules

foreach (($bytes = $stream->read(4096)) !== null) { // Will run forever
    printf("%s\n", $bytes);
}

// =================================

$wb = 0;
do {
    $wb = $stream->write($bytes);   // Size never changes

} while ($wb > 0); // Will never break

// =================================

$len = $stream->getLength(); // Will return PHP_INT_MAX
```
