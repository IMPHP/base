# [Base](base.md) / [I/O](io.md) / NullStream
 > im\io\NullStream
____

## Description
A stream implementation that reads and writes to `NULL`.

This is an unending stream that can be used mostly for testing purposes.
It can read bytes forever and anything written to it is disposed off, while acting as if it was written.

This can be compared to `/dev/null` and `/dev/urandom` on Linux.

## Synopsis
```php
class NullStream extends im\io\BaseStream implements Stringable, im\io\Stream {

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
    public getMetadata(): im\util\ImmutableMappedArray
    public getOffset(): int
    public seek(int $offset, int $whence = im\io\SEEK_SET): bool
    public truncate(int $size): bool
    public close(): void
    public write(string $string, bool $expand = FALSE): int
    public read(int $length): null|string
    public readLine(int $maxlen = -1): null|string
    public toString(): string

    // Inherited Methods
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
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__NullStream&nbsp;::&nbsp;DEF\_MODE__](io-NullStream-prop_DEF_MODE.md) | Default mode that is used when nothing else is defined |
| [__NullStream&nbsp;::&nbsp;F\_READABLE__](io-NullStream-prop_F_READABLE.md) | Stream is readable |
| [__NullStream&nbsp;::&nbsp;F\_WRITABLE__](io-NullStream-prop_F_WRITABLE.md) | Stream is writable |
| [__NullStream&nbsp;::&nbsp;F\_SEEKABLE__](io-NullStream-prop_F_SEEKABLE.md) | Stream is seekable |
| [__NullStream&nbsp;::&nbsp;F\_RW__](io-NullStream-prop_F_RW.md) | Stream is readable and writable (Multi bit) |
| [__NullStream&nbsp;::&nbsp;F\_RS__](io-NullStream-prop_F_RS.md) | Stream is readable and seekable (Multi bit) |
| [__NullStream&nbsp;::&nbsp;F\_WS__](io-NullStream-prop_F_WS.md) | Stream is writable and seekable (Multi bit) |
| [__NullStream&nbsp;::&nbsp;F\_RWS__](io-NullStream-prop_F_RWS.md) | Stream is readable, writable and seekable (Multi bit) |

## Methods
| Name | Description |
| :--- | :---------- |
| [__NullStream&nbsp;::&nbsp;\_\_construct__](io-NullStream-__construct.md) |  |
| [__NullStream&nbsp;::&nbsp;getMetadata__](io-NullStream-getMetadata.md) | Get the metadata for the underlaying resource |
| [__NullStream&nbsp;::&nbsp;getOffset__](io-NullStream-getOffset.md) | Get the current stream offset |
| [__NullStream&nbsp;::&nbsp;seek__](io-NullStream-seek.md) | Position the pointer at a different offset in the stream |
| [__NullStream&nbsp;::&nbsp;truncate__](io-NullStream-truncate.md) | Truncates a file to `$size` length |
| [__NullStream&nbsp;::&nbsp;close__](io-NullStream-close.md) | Close the underlaying resource |
| [__NullStream&nbsp;::&nbsp;write__](io-NullStream-write.md) | Write data to the stream |
| [__NullStream&nbsp;::&nbsp;read__](io-NullStream-read.md) | Read `$length` bytes from the stream |
| [__NullStream&nbsp;::&nbsp;readLine__](io-NullStream-readLine.md) | Read a line from the stream |
| [__NullStream&nbsp;::&nbsp;toString__](io-NullStream-toString.md) | Read and return the entire stream content |
| [__NullStream&nbsp;::&nbsp;getResource__](io-NullStream-getResource.md) | Returns the StreamWrapper for this object  The php resource returned here is mearly an abstraction allowing you to use this object on php functions requiring a php resource |
| [__NullStream&nbsp;::&nbsp;isWritable__](io-NullStream-isWritable.md) | Check if the stream is writable |
| [__NullStream&nbsp;::&nbsp;isReadable__](io-NullStream-isReadable.md) | Check if the stream is readable |
| [__NullStream&nbsp;::&nbsp;isSeekable__](io-NullStream-isSeekable.md) | Check if the stream is seekable |
| [__NullStream&nbsp;::&nbsp;getMode__](io-NullStream-getMode.md) | Returns the mode used by this stream  This is a string representation of the modes used to open the stream |
| [__NullStream&nbsp;::&nbsp;getFlags__](io-NullStream-getFlags.md) | Return the status flags for the current resource |
| [__NullStream&nbsp;::&nbsp;getLength__](io-NullStream-getLength.md) | Get the current length of the stream content |
| [__NullStream&nbsp;::&nbsp;isEOF__](io-NullStream-isEOF.md) | Check whether the stream is at the end |
| [__NullStream&nbsp;::&nbsp;rewind__](io-NullStream-rewind.md) | Rewind the pointer to point at the begining of the stream |
| [__NullStream&nbsp;::&nbsp;writeFromStream__](io-NullStream-writeFromStream.md) | Write data from another stream into this one |
| [__NullStream&nbsp;::&nbsp;allocate__](io-NullStream-allocate.md) | Allocate space at the pointer location |
| [__NullStream&nbsp;::&nbsp;clear__](io-NullStream-clear.md) | Clear the entire stream |

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
