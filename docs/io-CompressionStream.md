# [Base](base.md) / [I/O](io.md) / CompressionStream
 > im\io\CompressionStream
____

## Description
Defines a stream resource with compression features.

 > Any compression stream implementation must apply a specific header to the beginning of the stream.<br /><br />|----------|------------------------------------|---------------------------| | 4 bytes  | \xBB\x8A\x8E\xAB                   | SQSync Signature          | | 2 bytes  |                                    | Algo Signature            | | 4 bytes  |                                    | Algo Reserved             | | 8 bytes  | \x00\x00\x00\x00\x00\x00\x00\x00   | Uncompressed Data length  | | 4 bytes  | \x00\x00\x00\x00                   | Additional header length  | | * bytes  |                                    | Additional header content |<br /><br />The additional header can be set by using the `allocHeader()` and `writeHeader()` methods.  

## Synopsis
```php
interface CompressionStream implements im\io\Stream {

    // Constants
    SIGNATURE = '»ŠŽ«'

    // Inherited Constants
    string DEF_MODE = 'r+'
    int F_READABLE = 0b100
    int F_WRITABLE = 0b1000
    int F_SEEKABLE = 0b10000
    int F_RW = 0b1100
    int F_RS = 0b10100
    int F_WS = 0b11000
    int F_RWS = 0b11100

    // Methods
    readHeader(): null|string
    writeHeader(string $header): bool
    allocHeader(int $len): bool
    getAlgo(): string
    getAlgoSig(): string
    getRealLength(): int

    // Inherited Methods
    getResource(): resource
    getFlags(): int
    getMode(): null|string
    isWritable(): bool
    isReadable(): bool
    isSeekable(): bool
    getLength(): int
    getOffset(): int
    isEOF(): bool
    seek(int $offset, int $whence = SEEK_SET): bool
    rewind(): bool
    writeFromStream(im\io\Stream $stream): int
    write(string $string, bool $expand = FALSE): int
    read(int $length): null|string
    readLine(int $maxlen = -1): null|string
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
| [__CompressionStream&nbsp;::&nbsp;SIGNATURE__](io-CompressionStream-prop_SIGNATURE.md) | SQSync Signature |
| [__CompressionStream&nbsp;::&nbsp;DEF\_MODE__](io-CompressionStream-prop_DEF_MODE.md) | Default mode that is used when nothing else is defined |
| [__CompressionStream&nbsp;::&nbsp;F\_READABLE__](io-CompressionStream-prop_F_READABLE.md) | Stream is readable |
| [__CompressionStream&nbsp;::&nbsp;F\_WRITABLE__](io-CompressionStream-prop_F_WRITABLE.md) | Stream is writable |
| [__CompressionStream&nbsp;::&nbsp;F\_SEEKABLE__](io-CompressionStream-prop_F_SEEKABLE.md) | Stream is seekable |
| [__CompressionStream&nbsp;::&nbsp;F\_RW__](io-CompressionStream-prop_F_RW.md) | Stream is readable and writable (Multi bit) |
| [__CompressionStream&nbsp;::&nbsp;F\_RS__](io-CompressionStream-prop_F_RS.md) | Stream is readable and seekable (Multi bit) |
| [__CompressionStream&nbsp;::&nbsp;F\_WS__](io-CompressionStream-prop_F_WS.md) | Stream is writable and seekable (Multi bit) |
| [__CompressionStream&nbsp;::&nbsp;F\_RWS__](io-CompressionStream-prop_F_RWS.md) | Stream is readable, writable and seekable (Multi bit) |

## Methods
| Name | Description |
| :--- | :---------- |
| [__CompressionStream&nbsp;::&nbsp;readHeader__](io-CompressionStream-readHeader.md) | Read the additional header |
| [__CompressionStream&nbsp;::&nbsp;writeHeader__](io-CompressionStream-writeHeader.md) | Write additional header to stream |
| [__CompressionStream&nbsp;::&nbsp;allocHeader__](io-CompressionStream-allocHeader.md) | Allocate space for additional header |
| [__CompressionStream&nbsp;::&nbsp;getAlgo__](io-CompressionStream-getAlgo.md) | Get the name of the compression algorithm |
| [__CompressionStream&nbsp;::&nbsp;getAlgoSig__](io-CompressionStream-getAlgoSig.md) | Get the signature of the compression algorithm |
| [__CompressionStream&nbsp;::&nbsp;getRealLength__](io-CompressionStream-getRealLength.md) | Returns the uncompressed data length |
| [__CompressionStream&nbsp;::&nbsp;getResource__](io-CompressionStream-getResource.md) | Returns the StreamWrapper for this object  The php resource returned here is mearly an abstraction allowing you to use this object on php functions requiring a php resource |
| [__CompressionStream&nbsp;::&nbsp;getFlags__](io-CompressionStream-getFlags.md) | Return the status flags for the current resource |
| [__CompressionStream&nbsp;::&nbsp;getMode__](io-CompressionStream-getMode.md) | Returns the mode used by this stream  This is a string representation of the modes used to open the stream |
| [__CompressionStream&nbsp;::&nbsp;isWritable__](io-CompressionStream-isWritable.md) | Check if the stream is writable |
| [__CompressionStream&nbsp;::&nbsp;isReadable__](io-CompressionStream-isReadable.md) | Check if the stream is readable |
| [__CompressionStream&nbsp;::&nbsp;isSeekable__](io-CompressionStream-isSeekable.md) | Check if the stream is seekable |
| [__CompressionStream&nbsp;::&nbsp;getLength__](io-CompressionStream-getLength.md) | Get the current length of the stream content |
| [__CompressionStream&nbsp;::&nbsp;getOffset__](io-CompressionStream-getOffset.md) | Get the current stream offset |
| [__CompressionStream&nbsp;::&nbsp;isEOF__](io-CompressionStream-isEOF.md) | Check whether the stream is at the end |
| [__CompressionStream&nbsp;::&nbsp;seek__](io-CompressionStream-seek.md) | Position the pointer at a different offset in the stream |
| [__CompressionStream&nbsp;::&nbsp;rewind__](io-CompressionStream-rewind.md) | Rewind the pointer to point at the begining of the stream |
| [__CompressionStream&nbsp;::&nbsp;writeFromStream__](io-CompressionStream-writeFromStream.md) | Write data from another stream into this one |
| [__CompressionStream&nbsp;::&nbsp;write__](io-CompressionStream-write.md) | Write data to the stream |
| [__CompressionStream&nbsp;::&nbsp;read__](io-CompressionStream-read.md) | Read `$length` bytes from the stream |
| [__CompressionStream&nbsp;::&nbsp;readLine__](io-CompressionStream-readLine.md) | Read a line from the stream |
| [__CompressionStream&nbsp;::&nbsp;clear__](io-CompressionStream-clear.md) | Clear the entire stream |
| [__CompressionStream&nbsp;::&nbsp;truncate__](io-CompressionStream-truncate.md) | Truncates a file to `$size` length |
| [__CompressionStream&nbsp;::&nbsp;getMetadata__](io-CompressionStream-getMetadata.md) | Get the metadata for the underlaying resource |
| [__CompressionStream&nbsp;::&nbsp;close__](io-CompressionStream-close.md) | Close the underlaying resource |
| [__CompressionStream&nbsp;::&nbsp;toString__](io-CompressionStream-toString.md) | Read and return the entire stream content |
