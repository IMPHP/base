# [Base](base.md) / [I/O](io.md) / GZipStream
 > im\io\GZipStream
____

## Description
A CompressionStream that is backed by GZip DEFLATE

This stream will compress and decompress all data that is
read from and written to the backing stream.

This stream will add a header to the beginning of the stream.

| Length   | -                                  | Description               |
|----------|------------------------------------|---------------------------|
| 4 bytes  | \xBB\x8A\x8E\xAB                   | SQSync Signature          |
| 2 bytes  | \x1F\x8B                           | GZip Signature            |
| 4 bytes  | \x08\0\0\0                         | DEFLATE Signature         |
| 8 bytes  | \x00\x00\x00\x00\x00\x00\x00\x00   | Data length               |
| 4 bytes  | \x00\x00\x00\x00                   | Additional header length  |

The additional header can be set by using the `allocHeader()` and `writeHeader()` methods.

 > The stream uses GZip as it's compression backend, but it does not produce GZip headers. Also it compresses data based on block chunks that are specific to this stream alone. You cannot use other GZip tools to decompress this data.  

## Synopsis
```php
class GZipStream implements im\io\CompressionStream, im\io\Stream uses im\io\res\StreamDecorator {

    // Inherited Constants
    public SIGNATURE = '»ŠŽ«'
    public string DEF_MODE = 'r+'
    public int F_READABLE = 0b100
    public int F_WRITABLE = 0b1000
    public int F_SEEKABLE = 0b10000
    public int F_RW = 0b1100
    public int F_RS = 0b10100
    public int F_WS = 0b11000
    public int F_RWS = 0b11100

    // Methods
    public __construct(im\io\Stream $stream)
    public getAlgo(): string
    public getAlgoSig(): string
    public allocHeader(int $len): bool
    public getRealLength(): int
    public readHeader(): null|string
    public writeHeader(string $bytes): bool
    public close(bool $keepAlive = FALSE): void
    public getFlags(): int
    public isSeekable(): bool
    public getLength(bool $uncompressed = FALSE): int
    public getOffset(): int
    public isEOF(): bool
    public seek(int $offset, int $whence = im\io\SEEK_SET): bool
    public rewind(): bool
    public clear(): bool
    public truncate(int $size): bool
    public write(string $string, bool $expand = FALSE): int
    public read(int $length): null|string
    public readLine(int $maxlen = -1): null|string
    public getResource(): resource
    public getMode(): null|string
    public isWritable(): bool
    public isReadable(): bool
    public writeFromStream(im\io\Stream $stream): int
    public getMetadata(): im\util\Map
    public toString(): string
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__GZipStream&nbsp;::&nbsp;SIGNATURE__](io-GZipStream-prop_SIGNATURE.md) | SQSync Signature |
| [__GZipStream&nbsp;::&nbsp;DEF\_MODE__](io-GZipStream-prop_DEF_MODE.md) | Default mode that is used when nothing else is defined |
| [__GZipStream&nbsp;::&nbsp;F\_READABLE__](io-GZipStream-prop_F_READABLE.md) | Stream is readable |
| [__GZipStream&nbsp;::&nbsp;F\_WRITABLE__](io-GZipStream-prop_F_WRITABLE.md) | Stream is writable |
| [__GZipStream&nbsp;::&nbsp;F\_SEEKABLE__](io-GZipStream-prop_F_SEEKABLE.md) | Stream is seekable |
| [__GZipStream&nbsp;::&nbsp;F\_RW__](io-GZipStream-prop_F_RW.md) | Stream is readable and writable (Multi bit) |
| [__GZipStream&nbsp;::&nbsp;F\_RS__](io-GZipStream-prop_F_RS.md) | Stream is readable and seekable (Multi bit) |
| [__GZipStream&nbsp;::&nbsp;F\_WS__](io-GZipStream-prop_F_WS.md) | Stream is writable and seekable (Multi bit) |
| [__GZipStream&nbsp;::&nbsp;F\_RWS__](io-GZipStream-prop_F_RWS.md) | Stream is readable, writable and seekable (Multi bit) |

## Methods
| Name | Description |
| :--- | :---------- |
| [__GZipStream&nbsp;::&nbsp;\_\_construct__](io-GZipStream-__construct.md) | Create a new instance of GZipStream |
| [__GZipStream&nbsp;::&nbsp;getAlgo__](io-GZipStream-getAlgo.md) |  |
| [__GZipStream&nbsp;::&nbsp;getAlgoSig__](io-GZipStream-getAlgoSig.md) |  |
| [__GZipStream&nbsp;::&nbsp;allocHeader__](io-GZipStream-allocHeader.md) |  |
| [__GZipStream&nbsp;::&nbsp;getRealLength__](io-GZipStream-getRealLength.md) |  |
| [__GZipStream&nbsp;::&nbsp;readHeader__](io-GZipStream-readHeader.md) |  |
| [__GZipStream&nbsp;::&nbsp;writeHeader__](io-GZipStream-writeHeader.md) |  |
| [__GZipStream&nbsp;::&nbsp;close__](io-GZipStream-close.md) | Close this stream |
| [__GZipStream&nbsp;::&nbsp;getFlags__](io-GZipStream-getFlags.md) |  |
| [__GZipStream&nbsp;::&nbsp;isSeekable__](io-GZipStream-isSeekable.md) |  |
| [__GZipStream&nbsp;::&nbsp;getLength__](io-GZipStream-getLength.md) |  |
| [__GZipStream&nbsp;::&nbsp;getOffset__](io-GZipStream-getOffset.md) |  |
| [__GZipStream&nbsp;::&nbsp;isEOF__](io-GZipStream-isEOF.md) |  |
| [__GZipStream&nbsp;::&nbsp;seek__](io-GZipStream-seek.md) |  |
| [__GZipStream&nbsp;::&nbsp;rewind__](io-GZipStream-rewind.md) |  |
| [__GZipStream&nbsp;::&nbsp;clear__](io-GZipStream-clear.md) |  |
| [__GZipStream&nbsp;::&nbsp;truncate__](io-GZipStream-truncate.md) |  |
| [__GZipStream&nbsp;::&nbsp;write__](io-GZipStream-write.md) |  |
| [__GZipStream&nbsp;::&nbsp;read__](io-GZipStream-read.md) |  |
| [__GZipStream&nbsp;::&nbsp;readLine__](io-GZipStream-readLine.md) |  |
| [__GZipStream&nbsp;::&nbsp;getResource__](io-GZipStream-getResource.md) | Returns the StreamWrapper for this object  The php resource returned here is mearly an abstraction allowing you to use this object on php functions requiring a php resource |
| [__GZipStream&nbsp;::&nbsp;getMode__](io-GZipStream-getMode.md) | Returns the mode used by this stream  This is a string representation of the modes used to open the stream |
| [__GZipStream&nbsp;::&nbsp;isWritable__](io-GZipStream-isWritable.md) | Check if the stream is writable |
| [__GZipStream&nbsp;::&nbsp;isReadable__](io-GZipStream-isReadable.md) | Check if the stream is readable |
| [__GZipStream&nbsp;::&nbsp;writeFromStream__](io-GZipStream-writeFromStream.md) | Write data from another stream into this one |
| [__GZipStream&nbsp;::&nbsp;getMetadata__](io-GZipStream-getMetadata.md) | Get the metadata for the underlaying resource |
| [__GZipStream&nbsp;::&nbsp;toString__](io-GZipStream-toString.md) | Read and return the entire stream content |
