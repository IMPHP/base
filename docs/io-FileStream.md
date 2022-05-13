# [Base](base.md) / [I/O](io.md) / FileStream
 > im\io\FileStream
____

## Description
A stream implementation that can lazyly open files.

This is mostly the same as `RawStream`. The differences are:

 - You don't have to manually create a resource and parse it to the stream.
 - It has the option to lazily open the path when/if it's needed.

## Synopsis
```php
class FileStream implements im\io\Stream uses im\io\res\StreamDecorator {

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
    public __construct(string $file = 'php://temp', string $mode = im\io\Stream::DEF_MODE, bool $lazy = FALSE)
    public getResource(): resource
    public getFlags(int $mask = 0): int
    public getMode(): null|string
    public isWritable(): bool
    public isReadable(): bool
    public isSeekable(): bool
    public getLength(): int
    public getOffset(): int
    public isEOF(): bool
    public seek(int $offset, int $whence = im\io\res\SEEK_SET): bool
    public rewind(): bool
    public writeFromStream(im\io\Stream $stream): int
    public write(string $string, bool $expand = FALSE): int
    public read(int $length): null|string
    public readLine(int $maxlen = -1): null|string
    public clear(): bool
    public truncate(int $size): bool
    public getMetadata(): im\util\ImmutableMappedArray
    public close(): void
    public allocate(int $length): bool
    public toString(): string
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__FileStream&nbsp;::&nbsp;DEF\_MODE__](io-FileStream-prop_DEF_MODE.md) | Default mode that is used when nothing else is defined |
| [__FileStream&nbsp;::&nbsp;F\_READABLE__](io-FileStream-prop_F_READABLE.md) | Stream is readable |
| [__FileStream&nbsp;::&nbsp;F\_WRITABLE__](io-FileStream-prop_F_WRITABLE.md) | Stream is writable |
| [__FileStream&nbsp;::&nbsp;F\_SEEKABLE__](io-FileStream-prop_F_SEEKABLE.md) | Stream is seekable |
| [__FileStream&nbsp;::&nbsp;F\_RW__](io-FileStream-prop_F_RW.md) | Stream is readable and writable (Multi bit) |
| [__FileStream&nbsp;::&nbsp;F\_RS__](io-FileStream-prop_F_RS.md) | Stream is readable and seekable (Multi bit) |
| [__FileStream&nbsp;::&nbsp;F\_WS__](io-FileStream-prop_F_WS.md) | Stream is writable and seekable (Multi bit) |
| [__FileStream&nbsp;::&nbsp;F\_RWS__](io-FileStream-prop_F_RWS.md) | Stream is readable, writable and seekable (Multi bit) |

## Methods
| Name | Description |
| :--- | :---------- |
| [__FileStream&nbsp;::&nbsp;\_\_construct__](io-FileStream-__construct.md) |  |
| [__FileStream&nbsp;::&nbsp;getResource__](io-FileStream-getResource.md) | Returns the StreamWrapper for this object  The php resource returned here is mearly an abstraction allowing you to use this object on php functions requiring a php resource |
| [__FileStream&nbsp;::&nbsp;getFlags__](io-FileStream-getFlags.md) | Return the status flags for the current resource |
| [__FileStream&nbsp;::&nbsp;getMode__](io-FileStream-getMode.md) | Returns the mode used by this stream  This is a string representation of the modes used to open the stream |
| [__FileStream&nbsp;::&nbsp;isWritable__](io-FileStream-isWritable.md) | Check if the stream is writable |
| [__FileStream&nbsp;::&nbsp;isReadable__](io-FileStream-isReadable.md) | Check if the stream is readable |
| [__FileStream&nbsp;::&nbsp;isSeekable__](io-FileStream-isSeekable.md) | Check if the stream is seekable |
| [__FileStream&nbsp;::&nbsp;getLength__](io-FileStream-getLength.md) | Get the current length of the stream content |
| [__FileStream&nbsp;::&nbsp;getOffset__](io-FileStream-getOffset.md) | Get the current stream offset |
| [__FileStream&nbsp;::&nbsp;isEOF__](io-FileStream-isEOF.md) | Check whether the stream is at the end |
| [__FileStream&nbsp;::&nbsp;seek__](io-FileStream-seek.md) | Position the pointer at a different offset in the stream |
| [__FileStream&nbsp;::&nbsp;rewind__](io-FileStream-rewind.md) | Rewind the pointer to point at the begining of the stream |
| [__FileStream&nbsp;::&nbsp;writeFromStream__](io-FileStream-writeFromStream.md) | Write data from another stream into this one |
| [__FileStream&nbsp;::&nbsp;write__](io-FileStream-write.md) | Write data to the stream |
| [__FileStream&nbsp;::&nbsp;read__](io-FileStream-read.md) | Read `$length` bytes from the stream |
| [__FileStream&nbsp;::&nbsp;readLine__](io-FileStream-readLine.md) | Read a line from the stream |
| [__FileStream&nbsp;::&nbsp;clear__](io-FileStream-clear.md) | Clear the entire stream |
| [__FileStream&nbsp;::&nbsp;truncate__](io-FileStream-truncate.md) | Truncates a file to `$size` length |
| [__FileStream&nbsp;::&nbsp;getMetadata__](io-FileStream-getMetadata.md) | Get the metadata for the underlaying resource |
| [__FileStream&nbsp;::&nbsp;close__](io-FileStream-close.md) | Close the underlaying resource |
| [__FileStream&nbsp;::&nbsp;allocate__](io-FileStream-allocate.md) | Allocate space at the pointer location |
| [__FileStream&nbsp;::&nbsp;toString__](io-FileStream-toString.md) | Read and return the entire stream content |

## Example 1
```php
$stream = new FileStream($path, '+r', true);

foreach (($line = $stream->readLine()) !== null) { // File is opened here
    printf("%s\n", $line);
}

$stream->close();
```
