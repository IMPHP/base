# [Base](base.md) / [I/O](io.md) / BaseStream
 > im\io\BaseStream
____

## Description
Base stream that implements some basics from the `Stream` interface.

## Synopsis
```php
abstract class BaseStream implements im\io\Stream, Stringable {

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
    public __construct()
    public getResource(): resource
    public isWritable(): bool
    public isReadable(): bool
    public isSeekable(): bool
    public getMode(): null|string
    public getFlags(int $mask = 0): int
    public getLength(): int
    public isEOF(): bool
    public rewind(): bool
    public writeFromStream(im\io\Stream $stream): int
    public allocate(int $length): bool
    public clear(): bool
    public toString(): string

    // Inherited Methods
    abstract public getOffset(): int
    abstract public seek(int $offset, int $whence = im\io\SEEK_SET): bool
    abstract public write(string $string, bool $expand = FALSE): int
    abstract public read(int $length): null|string
    abstract public readLine(int $maxlen = -1): null|string
    abstract public truncate(int $size): bool
    abstract public getMetadata(): im\util\ImmutableMappedArray
    abstract public close(): void
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__BaseStream&nbsp;::&nbsp;DEF\_MODE__](io-BaseStream-prop_DEF_MODE.md) | Default mode that is used when nothing else is defined |
| [__BaseStream&nbsp;::&nbsp;F\_READABLE__](io-BaseStream-prop_F_READABLE.md) | Stream is readable |
| [__BaseStream&nbsp;::&nbsp;F\_WRITABLE__](io-BaseStream-prop_F_WRITABLE.md) | Stream is writable |
| [__BaseStream&nbsp;::&nbsp;F\_SEEKABLE__](io-BaseStream-prop_F_SEEKABLE.md) | Stream is seekable |
| [__BaseStream&nbsp;::&nbsp;F\_RW__](io-BaseStream-prop_F_RW.md) | Stream is readable and writable (Multi bit) |
| [__BaseStream&nbsp;::&nbsp;F\_RS__](io-BaseStream-prop_F_RS.md) | Stream is readable and seekable (Multi bit) |
| [__BaseStream&nbsp;::&nbsp;F\_WS__](io-BaseStream-prop_F_WS.md) | Stream is writable and seekable (Multi bit) |
| [__BaseStream&nbsp;::&nbsp;F\_RWS__](io-BaseStream-prop_F_RWS.md) | Stream is readable, writable and seekable (Multi bit) |

## Methods
| Name | Description |
| :--- | :---------- |
| [__BaseStream&nbsp;::&nbsp;\_\_construct__](io-BaseStream-__construct.md) |  |
| [__BaseStream&nbsp;::&nbsp;getResource__](io-BaseStream-getResource.md) | Returns the StreamWrapper for this object  The php resource returned here is mearly an abstraction allowing you to use this object on php functions requiring a php resource |
| [__BaseStream&nbsp;::&nbsp;isWritable__](io-BaseStream-isWritable.md) | Check if the stream is writable |
| [__BaseStream&nbsp;::&nbsp;isReadable__](io-BaseStream-isReadable.md) | Check if the stream is readable |
| [__BaseStream&nbsp;::&nbsp;isSeekable__](io-BaseStream-isSeekable.md) | Check if the stream is seekable |
| [__BaseStream&nbsp;::&nbsp;getMode__](io-BaseStream-getMode.md) | Returns the mode used by this stream  This is a string representation of the modes used to open the stream |
| [__BaseStream&nbsp;::&nbsp;getFlags__](io-BaseStream-getFlags.md) | Return the status flags for the current resource |
| [__BaseStream&nbsp;::&nbsp;getLength__](io-BaseStream-getLength.md) | Get the current length of the stream content |
| [__BaseStream&nbsp;::&nbsp;isEOF__](io-BaseStream-isEOF.md) | Check whether the stream is at the end |
| [__BaseStream&nbsp;::&nbsp;rewind__](io-BaseStream-rewind.md) | Rewind the pointer to point at the begining of the stream |
| [__BaseStream&nbsp;::&nbsp;writeFromStream__](io-BaseStream-writeFromStream.md) | Write data from another stream into this one |
| [__BaseStream&nbsp;::&nbsp;allocate__](io-BaseStream-allocate.md) | Allocate space at the pointer location |
| [__BaseStream&nbsp;::&nbsp;clear__](io-BaseStream-clear.md) | Clear the entire stream |
| [__BaseStream&nbsp;::&nbsp;toString__](io-BaseStream-toString.md) | Read and return the entire stream content |
| [__BaseStream&nbsp;::&nbsp;getOffset__](io-BaseStream-getOffset.md) | Get the current stream offset |
| [__BaseStream&nbsp;::&nbsp;seek__](io-BaseStream-seek.md) | Position the pointer at a different offset in the stream |
| [__BaseStream&nbsp;::&nbsp;write__](io-BaseStream-write.md) | Write data to the stream |
| [__BaseStream&nbsp;::&nbsp;read__](io-BaseStream-read.md) | Read `$length` bytes from the stream |
| [__BaseStream&nbsp;::&nbsp;readLine__](io-BaseStream-readLine.md) | Read a line from the stream |
| [__BaseStream&nbsp;::&nbsp;truncate__](io-BaseStream-truncate.md) | Truncates a file to `$size` length |
| [__BaseStream&nbsp;::&nbsp;getMetadata__](io-BaseStream-getMetadata.md) | Get the metadata for the underlaying resource |
| [__BaseStream&nbsp;::&nbsp;close__](io-BaseStream-close.md) | Close the underlaying resource |
