# [Base](base.md) / [I/O](io.md) / StreamDecorator
 > im\io\res\StreamDecorator
____

## Description
Provides implementation for `im\io\Stream`.

This can be used to easily create abstractions for `Stream` objects.
It provides all the implementation from `im\io\Stream` and redirects it to
an underlaying `im\io\Stream` instance via `$this->stream`.

## Synopsis
```php
trait StreamDecorator implements Stringable {

    // Properties
    public im\io\Stream $stream

    // Methods
    public getResource(): resource
    public getFlags(): int
    public getMode(): null|string
    public isWritable(): bool
    public isReadable(): bool
    public isSeekable(): bool
    public getLength(): int
    public getOffset(): int
    public isEOF(): bool
    public seek(int $offset, int $whence = SEEK_SET): bool
    public rewind(): bool
    public writeFromStream(im\io\Stream $stream): int
    public write(string $string, bool $expand = FALSE): int
    public read(int $length): null|string
    public readLine(int $maxlen = -1): null|string
    public clear(): bool
    public truncate(int $size): bool
    public getMetadata(): im\util\Map
    public close(): void
    public toString(): string
}
```

## Properties
| Name | Description |
| :--- | :---------- |
| [__StreamDecorator&nbsp;::&nbsp;$stream__](io-StreamDecorator-var_stream.md) | Property used by this Trait to access the underlaying `Stream` |

## Methods
| Name | Description |
| :--- | :---------- |
| [__StreamDecorator&nbsp;::&nbsp;getResource__](io-StreamDecorator-getResource.md) | Returns the StreamWrapper for this object  The php resource returned here is mearly an abstraction allowing you to use this object on php functions requiring a php resource |
| [__StreamDecorator&nbsp;::&nbsp;getFlags__](io-StreamDecorator-getFlags.md) | Return the status flags for the current resource |
| [__StreamDecorator&nbsp;::&nbsp;getMode__](io-StreamDecorator-getMode.md) | Returns the mode used by this stream  This is a string representation of the modes used to open the stream |
| [__StreamDecorator&nbsp;::&nbsp;isWritable__](io-StreamDecorator-isWritable.md) | Check if the stream is writable |
| [__StreamDecorator&nbsp;::&nbsp;isReadable__](io-StreamDecorator-isReadable.md) | Check if the stream is readable |
| [__StreamDecorator&nbsp;::&nbsp;isSeekable__](io-StreamDecorator-isSeekable.md) | Check if the stream is seekable |
| [__StreamDecorator&nbsp;::&nbsp;getLength__](io-StreamDecorator-getLength.md) | Get the current length of the stream content |
| [__StreamDecorator&nbsp;::&nbsp;getOffset__](io-StreamDecorator-getOffset.md) | Get the current stream offset |
| [__StreamDecorator&nbsp;::&nbsp;isEOF__](io-StreamDecorator-isEOF.md) | Check whether the stream is at the end |
| [__StreamDecorator&nbsp;::&nbsp;seek__](io-StreamDecorator-seek.md) | Position the pointer at a different offset in the stream |
| [__StreamDecorator&nbsp;::&nbsp;rewind__](io-StreamDecorator-rewind.md) | Rewind the pointer to point at the begining of the stream |
| [__StreamDecorator&nbsp;::&nbsp;writeFromStream__](io-StreamDecorator-writeFromStream.md) | Write data from another stream into this one |
| [__StreamDecorator&nbsp;::&nbsp;write__](io-StreamDecorator-write.md) | Write data to the stream |
| [__StreamDecorator&nbsp;::&nbsp;read__](io-StreamDecorator-read.md) | Read `$length` bytes from the stream |
| [__StreamDecorator&nbsp;::&nbsp;readLine__](io-StreamDecorator-readLine.md) | Read a line from the stream |
| [__StreamDecorator&nbsp;::&nbsp;clear__](io-StreamDecorator-clear.md) | Clear the entire stream |
| [__StreamDecorator&nbsp;::&nbsp;truncate__](io-StreamDecorator-truncate.md) | Truncates a file to `$size` length |
| [__StreamDecorator&nbsp;::&nbsp;getMetadata__](io-StreamDecorator-getMetadata.md) | Get the metadata for the underlaying resource |
| [__StreamDecorator&nbsp;::&nbsp;close__](io-StreamDecorator-close.md) | Close the underlaying resource |
| [__StreamDecorator&nbsp;::&nbsp;toString__](io-StreamDecorator-toString.md) | Read and return the entire stream content |

## Example 1
```php
class MyStream implements Stream {
    use StreamDecorator;

    public function __construct(Stream $stream) {
        $this->stream = $stream;
    }

    public function write(string $string, bool $expand = false): int {
        // Extend and change the behavior of this particular method
    }
}
```
