# [Base](base.md) / [I/O](io.md) / StringStream
 > im\io\StringStream
____

## Description
A string based Stream implementation.

This `Stream` writes and reads data from a string.
Using `RawStream` with `php://temp` is the best option for temp storage,
but there may be situations where you have a string that you wish to read/write
in a particular way. This Stream also allows you to add a `string` by reference.

## Synopsis
```php
class StringStream extends im\io\BaseStream implements Stringable, im\io\Stream {

    // Inherited Constants
    public string DEF_MODE = 'r+'
    public int F_READABLE = 0b100
    public int F_WRITABLE = 0b1000
    public int F_SEEKABLE = 0b10000
    public int F_RW = 0b1100
    public int F_RS = 0b10100
    public int F_WS = 0b11000
    public int F_RWS = 0b11100

    // Methods
    public __construct(string $mode = im\io\Stream::DEF_MODE)
    public attachStream(string &$stream): void
    public getFlags(int $mask = 0): int
    public getMode(): null|string
    public getLength(): int
    public getOffset(): int
    public seek(int $offset, int $whence = im\io\SEEK_SET): bool
    public truncate(int $size): bool
    public close(): void
    public write(string $string, bool $expand = FALSE): int
    public read(int $length): null|string
    public readLine(int $maxlen = -1): null|string
    public getMetadata(): im\util\ImmutableMappedArray

    // Inherited Methods
    public getResource(): resource
    public isWritable(): bool
    public isReadable(): bool
    public isSeekable(): bool
    public isEOF(): bool
    public rewind(): bool
    public writeFromStream(im\io\Stream $stream): int
    public allocate(int $length): bool
    public clear(): bool
    public toString(): string
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__StringStream&nbsp;::&nbsp;DEF\_MODE__](io-StringStream-prop_DEF_MODE.md) | Default mode that is used when nothing else is defined |
| [__StringStream&nbsp;::&nbsp;F\_READABLE__](io-StringStream-prop_F_READABLE.md) | Stream is readable |
| [__StringStream&nbsp;::&nbsp;F\_WRITABLE__](io-StringStream-prop_F_WRITABLE.md) | Stream is writable |
| [__StringStream&nbsp;::&nbsp;F\_SEEKABLE__](io-StringStream-prop_F_SEEKABLE.md) | Stream is seekable |
| [__StringStream&nbsp;::&nbsp;F\_RW__](io-StringStream-prop_F_RW.md) | Stream is readable and writable (Multi bit) |
| [__StringStream&nbsp;::&nbsp;F\_RS__](io-StringStream-prop_F_RS.md) | Stream is readable and seekable (Multi bit) |
| [__StringStream&nbsp;::&nbsp;F\_WS__](io-StringStream-prop_F_WS.md) | Stream is writable and seekable (Multi bit) |
| [__StringStream&nbsp;::&nbsp;F\_RWS__](io-StringStream-prop_F_RWS.md) | Stream is readable, writable and seekable (Multi bit) |

## Methods
| Name | Description |
| :--- | :---------- |
| [__StringStream&nbsp;::&nbsp;\_\_construct__](io-StringStream-__construct.md) |  |
| [__StringStream&nbsp;::&nbsp;attachStream__](io-StringStream-attachStream.md) | Attach a referenced string variable |
| [__StringStream&nbsp;::&nbsp;getFlags__](io-StringStream-getFlags.md) | Return the status flags for the current resource |
| [__StringStream&nbsp;::&nbsp;getMode__](io-StringStream-getMode.md) | Returns the mode used by this stream  This is a string representation of the modes used to open the stream |
| [__StringStream&nbsp;::&nbsp;getLength__](io-StringStream-getLength.md) | Get the current length of the stream content |
| [__StringStream&nbsp;::&nbsp;getOffset__](io-StringStream-getOffset.md) | Get the current stream offset |
| [__StringStream&nbsp;::&nbsp;seek__](io-StringStream-seek.md) | Position the pointer at a different offset in the stream |
| [__StringStream&nbsp;::&nbsp;truncate__](io-StringStream-truncate.md) | Truncates a file to `$size` length |
| [__StringStream&nbsp;::&nbsp;close__](io-StringStream-close.md) | Close the underlaying resource |
| [__StringStream&nbsp;::&nbsp;write__](io-StringStream-write.md) | Write data to the stream |
| [__StringStream&nbsp;::&nbsp;read__](io-StringStream-read.md) | Read `$length` bytes from the stream |
| [__StringStream&nbsp;::&nbsp;readLine__](io-StringStream-readLine.md) | Read a line from the stream |
| [__StringStream&nbsp;::&nbsp;getMetadata__](io-StringStream-getMetadata.md) | Get the metadata for the underlaying resource |
| [__StringStream&nbsp;::&nbsp;getResource__](io-StringStream-getResource.md) | Returns the StreamWrapper for this object  The php resource returned here is mearly an abstraction allowing you to use this object on php functions requiring a php resource |
| [__StringStream&nbsp;::&nbsp;isWritable__](io-StringStream-isWritable.md) | Check if the stream is writable |
| [__StringStream&nbsp;::&nbsp;isReadable__](io-StringStream-isReadable.md) | Check if the stream is readable |
| [__StringStream&nbsp;::&nbsp;isSeekable__](io-StringStream-isSeekable.md) | Check if the stream is seekable |
| [__StringStream&nbsp;::&nbsp;isEOF__](io-StringStream-isEOF.md) | Check whether the stream is at the end |
| [__StringStream&nbsp;::&nbsp;rewind__](io-StringStream-rewind.md) | Rewind the pointer to point at the begining of the stream |
| [__StringStream&nbsp;::&nbsp;writeFromStream__](io-StringStream-writeFromStream.md) | Write data from another stream into this one |
| [__StringStream&nbsp;::&nbsp;allocate__](io-StringStream-allocate.md) | Allocate space at the pointer location |
| [__StringStream&nbsp;::&nbsp;clear__](io-StringStream-clear.md) | Clear the entire stream |
| [__StringStream&nbsp;::&nbsp;toString__](io-StringStream-toString.md) | Read and return the entire stream content |
