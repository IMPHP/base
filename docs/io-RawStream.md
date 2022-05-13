# [Base](base.md) / [I/O](io.md) / RawStream
 > im\io\RawStream
____

## Description
A stream implementation that wrappes a PHP `resource`.

## Synopsis
```php
class RawStream extends im\io\BaseStream implements Stringable, im\io\Stream {

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
    public __construct(resource $res = NULL)
    public getFlags(int $mask = 0): int
    public getLength(): int
    public getOffset(): int
    public isEOF(): bool
    public seek(int $offset, int $whence = im\io\SEEK_SET): bool
    public truncate(int $size): bool
    public close(): void
    public getMetadata(): im\util\ImmutableMappedArray
    public write(string $string, bool $expand = FALSE): int
    public read(int $length): null|string
    public readLine(int $maxlen = -1): null|string

    // Inherited Methods
    public getResource(): resource
    public isWritable(): bool
    public isReadable(): bool
    public isSeekable(): bool
    public getMode(): null|string
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
| [__RawStream&nbsp;::&nbsp;DEF\_MODE__](io-RawStream-prop_DEF_MODE.md) | Default mode that is used when nothing else is defined |
| [__RawStream&nbsp;::&nbsp;F\_READABLE__](io-RawStream-prop_F_READABLE.md) | Stream is readable |
| [__RawStream&nbsp;::&nbsp;F\_WRITABLE__](io-RawStream-prop_F_WRITABLE.md) | Stream is writable |
| [__RawStream&nbsp;::&nbsp;F\_SEEKABLE__](io-RawStream-prop_F_SEEKABLE.md) | Stream is seekable |
| [__RawStream&nbsp;::&nbsp;F\_RW__](io-RawStream-prop_F_RW.md) | Stream is readable and writable (Multi bit) |
| [__RawStream&nbsp;::&nbsp;F\_RS__](io-RawStream-prop_F_RS.md) | Stream is readable and seekable (Multi bit) |
| [__RawStream&nbsp;::&nbsp;F\_WS__](io-RawStream-prop_F_WS.md) | Stream is writable and seekable (Multi bit) |
| [__RawStream&nbsp;::&nbsp;F\_RWS__](io-RawStream-prop_F_RWS.md) | Stream is readable, writable and seekable (Multi bit) |

## Methods
| Name | Description |
| :--- | :---------- |
| [__RawStream&nbsp;::&nbsp;\_\_construct__](io-RawStream-__construct.md) |  |
| [__RawStream&nbsp;::&nbsp;getFlags__](io-RawStream-getFlags.md) | Return the status flags for the current resource |
| [__RawStream&nbsp;::&nbsp;getLength__](io-RawStream-getLength.md) | Get the current length of the stream content |
| [__RawStream&nbsp;::&nbsp;getOffset__](io-RawStream-getOffset.md) | Get the current stream offset |
| [__RawStream&nbsp;::&nbsp;isEOF__](io-RawStream-isEOF.md) | Check whether the stream is at the end |
| [__RawStream&nbsp;::&nbsp;seek__](io-RawStream-seek.md) | Position the pointer at a different offset in the stream |
| [__RawStream&nbsp;::&nbsp;truncate__](io-RawStream-truncate.md) | Truncates a file to `$size` length |
| [__RawStream&nbsp;::&nbsp;close__](io-RawStream-close.md) | Close the underlaying resource |
| [__RawStream&nbsp;::&nbsp;getMetadata__](io-RawStream-getMetadata.md) | Get the metadata for the underlaying resource |
| [__RawStream&nbsp;::&nbsp;write__](io-RawStream-write.md) | Write data to the stream |
| [__RawStream&nbsp;::&nbsp;read__](io-RawStream-read.md) | Read `$length` bytes from the stream |
| [__RawStream&nbsp;::&nbsp;readLine__](io-RawStream-readLine.md) | Read a line from the stream |
| [__RawStream&nbsp;::&nbsp;getResource__](io-RawStream-getResource.md) | Returns the StreamWrapper for this object  The php resource returned here is mearly an abstraction allowing you to use this object on php functions requiring a php resource |
| [__RawStream&nbsp;::&nbsp;isWritable__](io-RawStream-isWritable.md) | Check if the stream is writable |
| [__RawStream&nbsp;::&nbsp;isReadable__](io-RawStream-isReadable.md) | Check if the stream is readable |
| [__RawStream&nbsp;::&nbsp;isSeekable__](io-RawStream-isSeekable.md) | Check if the stream is seekable |
| [__RawStream&nbsp;::&nbsp;getMode__](io-RawStream-getMode.md) | Returns the mode used by this stream  This is a string representation of the modes used to open the stream |
| [__RawStream&nbsp;::&nbsp;rewind__](io-RawStream-rewind.md) | Rewind the pointer to point at the begining of the stream |
| [__RawStream&nbsp;::&nbsp;writeFromStream__](io-RawStream-writeFromStream.md) | Write data from another stream into this one |
| [__RawStream&nbsp;::&nbsp;allocate__](io-RawStream-allocate.md) | Allocate space at the pointer location |
| [__RawStream&nbsp;::&nbsp;clear__](io-RawStream-clear.md) | Clear the entire stream |
| [__RawStream&nbsp;::&nbsp;toString__](io-RawStream-toString.md) | Read and return the entire stream content |

## Example 1
```php
$stream = new RawStream( fopen($path, 'r+') );

foreach (($line = $stream->readLine()) !== null) {
    printf("%s\n", $line);
}

$stream->close();
```
