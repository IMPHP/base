# [Base](base.md) / [I/O](io.md) / Stream
 > im\io\Stream
____

## Description
Defines a stream resource that can be written and/or read from.

## Synopsis
```php
interface Stream {

    // Constants
    string DEF_MODE = 'r+'
    int F_READABLE = 0b100
    int F_WRITABLE = 0b1000
    int F_SEEKABLE = 0b10000
    int F_RW = 0b1100
    int F_RS = 0b10100
    int F_WS = 0b11000
    int F_RWS = 0b11100

    // Methods
    getResource(): resource
    getFlags(int $mask = 0): int
    getMode(): null|string
    isWritable(): bool
    isReadable(): bool
    isSeekable(): bool
    getLength(): int
    getOffset(): int
    isEOF(): bool
    seek(int $offset, int $whence = im\io\SEEK_SET): bool
    rewind(): bool
    writeFromStream(im\io\Stream $stream): int
    write(string $string, bool $expand = FALSE): int
    read(int $length): null|string
    readLine(int $maxlen = -1): null|string
    allocate(int $length): bool
    clear(): bool
    truncate(int $size): bool
    getMetadata(): im\util\ImmutableMappedArray
    close(): void
    toString(): string
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__Stream&nbsp;::&nbsp;DEF\_MODE__](io-Stream-prop_DEF_MODE.md) | Default mode that is used when nothing else is defined |
| [__Stream&nbsp;::&nbsp;F\_READABLE__](io-Stream-prop_F_READABLE.md) | Stream is readable |
| [__Stream&nbsp;::&nbsp;F\_WRITABLE__](io-Stream-prop_F_WRITABLE.md) | Stream is writable |
| [__Stream&nbsp;::&nbsp;F\_SEEKABLE__](io-Stream-prop_F_SEEKABLE.md) | Stream is seekable |
| [__Stream&nbsp;::&nbsp;F\_RW__](io-Stream-prop_F_RW.md) | Stream is readable and writable (Multi bit) |
| [__Stream&nbsp;::&nbsp;F\_RS__](io-Stream-prop_F_RS.md) | Stream is readable and seekable (Multi bit) |
| [__Stream&nbsp;::&nbsp;F\_WS__](io-Stream-prop_F_WS.md) | Stream is writable and seekable (Multi bit) |
| [__Stream&nbsp;::&nbsp;F\_RWS__](io-Stream-prop_F_RWS.md) | Stream is readable, writable and seekable (Multi bit) |

## Methods
| Name | Description |
| :--- | :---------- |
| [__Stream&nbsp;::&nbsp;getResource__](io-Stream-getResource.md) | Returns the StreamWrapper for this object  The php resource returned here is mearly an abstraction allowing you to use this object on php functions requiring a php resource |
| [__Stream&nbsp;::&nbsp;getFlags__](io-Stream-getFlags.md) | Return the status flags for the current resource |
| [__Stream&nbsp;::&nbsp;getMode__](io-Stream-getMode.md) | Returns the mode used by this stream  This is a string representation of the modes used to open the stream |
| [__Stream&nbsp;::&nbsp;isWritable__](io-Stream-isWritable.md) | Check if the stream is writable |
| [__Stream&nbsp;::&nbsp;isReadable__](io-Stream-isReadable.md) | Check if the stream is readable |
| [__Stream&nbsp;::&nbsp;isSeekable__](io-Stream-isSeekable.md) | Check if the stream is seekable |
| [__Stream&nbsp;::&nbsp;getLength__](io-Stream-getLength.md) | Get the current length of the stream content |
| [__Stream&nbsp;::&nbsp;getOffset__](io-Stream-getOffset.md) | Get the current stream offset |
| [__Stream&nbsp;::&nbsp;isEOF__](io-Stream-isEOF.md) | Check whether the stream is at the end |
| [__Stream&nbsp;::&nbsp;seek__](io-Stream-seek.md) | Position the pointer at a different offset in the stream |
| [__Stream&nbsp;::&nbsp;rewind__](io-Stream-rewind.md) | Rewind the pointer to point at the begining of the stream |
| [__Stream&nbsp;::&nbsp;writeFromStream__](io-Stream-writeFromStream.md) | Write data from another stream into this one |
| [__Stream&nbsp;::&nbsp;write__](io-Stream-write.md) | Write data to the stream |
| [__Stream&nbsp;::&nbsp;read__](io-Stream-read.md) | Read `$length` bytes from the stream |
| [__Stream&nbsp;::&nbsp;readLine__](io-Stream-readLine.md) | Read a line from the stream |
| [__Stream&nbsp;::&nbsp;allocate__](io-Stream-allocate.md) | Allocate space at the pointer location |
| [__Stream&nbsp;::&nbsp;clear__](io-Stream-clear.md) | Clear the entire stream |
| [__Stream&nbsp;::&nbsp;truncate__](io-Stream-truncate.md) | Truncates a file to `$size` length |
| [__Stream&nbsp;::&nbsp;getMetadata__](io-Stream-getMetadata.md) | Get the metadata for the underlaying resource |
| [__Stream&nbsp;::&nbsp;close__](io-Stream-close.md) | Close the underlaying resource |
| [__Stream&nbsp;::&nbsp;toString__](io-Stream-toString.md) | Read and return the entire stream content |
