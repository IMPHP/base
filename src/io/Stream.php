<?php declare(strict_types=1);
/*
 * This file is part of the IMPHP Project: https://github.com/IMPHP
 *
 * Copyright (c) 2016 Daniel Bergløv, License: MIT
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO
 * THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR
 * THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace im\io;

use im\util\MapArray;
use const SEEK_SET;

/**
 * Defines a stream resource that can be written and/or read from.
 */
interface Stream {

    /** @internal Writable modes */
    const M_WRITABLE = '/r(?:b)?\+|[waxc]/';

    /** @internal Readable modes */
    const M_READABLE = '/[waxc](?:b)?\+|r/';

    /**
     * Default mode that is used when nothing else is defined.
     *
     * @var string
     */
    const DEF_MODE = "r+";

    /**
     * Stream is readable
     *
     * @var int = 0b100
     */
    const F_READABLE = 0b100;

    /**
     * Stream is writable
     *
     * @var int = 0b1000
     */
    const F_WRITABLE = 0b1000;

    /**
     * Stream is seekable
     *
     * @var int = 0b10000
     */
    const F_SEEKABLE = 0b10000;

    /**
     * Stream is readable and writable (Multi bit)
     *
     * @var int = 0b1100
     */
    const F_RW = 0b1100;

    /**
     * Stream is readable and seekable (Multi bit)
     *
     * @var int = 0b10100
     */
    const F_RS = 0b10100;

    /**
     * Stream is writable and seekable (Multi bit)
     *
     * @var int = 0b11000
     */
    const F_WS = 0b11000;

    /**
     * Stream is readable, writable and seekable (Multi bit)
     *
     * @var int = 0b11100
     */
    const F_RWS = 0b11100;

    /**
     * Returns the StreamWrapper for this object
     *
     * The php resource returned here is mearly an abstraction
     * allowing you to use this object on php functions requiring
     * a php resource. Any actions performed on the StreamWrapper
     * is performed on this object through the wrapper.
     * This includes calling `fclose()`.
     *
     * @return resource
     *      A PHP `resource` that uses this stream via the stream wrapper.
     */
    function getResource() /*resource*/;

    /**
     * Return the status flags for the current resource.
     *
     * You can use the `Stream::F_` constants to sort
     * out the different bits and their meaning.
     *
     * @param $mask
     *      Mask to sort the flags before returning them
     */
    function getFlags(int $mask = 0): int;

    /**
     * Returns the mode used by this stream
     *
     * This is a string representation of the modes
     * used to open the stream. You can use `::getFlags()`
     * instead to check for things like readability and such or use the
     * dedicated methods `::isWritable()`, `::isReadable()` and `::isSeekable()`.
     *
     * @return
     *      Returns NULL if this for some reason is not available.
     */
    function getMode(): ?string;

    /**
     * Check if the stream is writable.
     *
     * @note
     *      This is the same as `$this->getFlags() & static::F_WRITEABLE > 0`
     */
    function isWritable(): bool;

    /**
     * Check if the stream is readable.
     *
     * @note
     *      This is the same as `$this->getFlags() & static::F_READABLE > 0`
     */
    function isReadable(): bool;

    /**
     * Check if the stream is seekable.
     *
     * @note
     *      This is the same as `$this->getFlags() & static::F_SEEKABLE > 0`
     */
    function isSeekable(): bool;

    /**
     * Get the current length of the stream content.
     *
     * @return
     *      Returns the current length in bytes or `-1` if length is unknown.
     */
    function getLength(): int;

    /**
     * Get the current stream offset
     *
     * @return
     *      Return `-1` if offset could not be read
     */
    function getOffset(): int;

    /**
     * Check whether the stream is at the end.
     */
    function isEOF(): bool;

    /**
     * Position the pointer at a different offset in the stream.
     * Any new reads or writes will be performed from this offset in the stream.
     *
     * @note
     *      Any writes may override existing data below this offset.
     *
     * @param $offset
     *      A new offset for the pointer.
     *
     * @param $whence
     *      `https://secure.php.net/manual/en/function.fseek.php`
     *
     * @return
     *      It may fail and return `false` if the stream is not seekable.
     */
    function seek(int $offset, int $whence = SEEK_SET): bool;

    /**
     * Rewind the pointer to point at the begining of the stream.
     *
     * @note
     *      This is the same as `$this->seek(0)`.
     *
     * @return
     *      It may fail and return `false` if the stream is not seekable.
     */
    function rewind(): bool;

    /**
     * Write data from another stream into this one.
     *
     * Data will be read from the current offset of the source stream
     * and written to the current offset of the target. Any data
     * following the target offset will be overridden.
     *
     * @param $stream
     *      The source strem to read from.
     *
     * @return
     *      Returns the number of bytes written or `-1` if it failed.
     */
    function writeFromStream(Stream $stream): int;

    /**
     * Write data to the stream.
     *
     * @param $string
     *      The data to write.
     *
     * @param $expand
     *      If true, data that is not written at the end of the stream,
     *      will expand the current content and new data will be written
     *      in between. Otherwise new data will truncate existing content
     *      at the current offset. Warning though, this may be a bit slower
     *      operation than normal writes, depending on the stream type.
     *
     * @return
     *      Returns the number of bytes written or `-1` if it failed.
     */
    function write(string $string, bool $expand = false): int;

    /**
     * Read `$length` bytes from the stream.
     *
     * @param $length
     *      Number of bytes to read.
     *
     * @return
     *      The bytes that was read or `NULL` on EOF.
     */
    function read(int $length): ?string;

    /**
     * Read a line from the stream.
     *
     * Careful, if the stream has no line endings,
     * this may read a very large ammount of data into memory.
     * The read does not stop until a line ending or EOF
     * has been reached, unless `$maxlen` has been defined.
     *
     * @param $maxlen
     *      Max bytes to read before stop, regardless of line endings.
     *
     * @return
     *      The bytes that was read or `NULL` on EOF.
     */
    function readLine(int $maxlen = -1): ?string;

    /**
     * Allocate space at the pointer location.
     *
     * This method will allocate `$length` bytes in front of the file pointer.
     * Any conetent after the pointer location is pushed forward, allocating
     * the space in between.
     *
     * @note
     *      The pointer is reset to the current position after allocation.
     *
     * @note
     *      This method requires the stream to be `readable`, `writable` and `seekable`.
     *      It also does not work if the stream was opened with `a` mode.
     *
     * @param $length
     *      Length in bytes to allocate
     */
    function allocate(int $length): bool;

    /**
     * Clear the entire stream.
     *
     * @note
     *      This is the same as `$this->truncate(0)`
     *
     * @return
     *      It may fail and return `false` if the stream is not
     *      writable or seekable.
     */
    function clear(): bool;

    /**
     * Truncates a file to `$size` length.
     *
     * @param $size
     *      Length to truncate to.
     *
     * @return
     *      It may fail and return `false` if the stream is not
     *      writable or seekable.
     */
    function truncate(int $size): bool;

    /**
     * Get the metadata for the underlaying resource.
     *
     * `https://www.php.net/manual/en/function.stream-get-meta-data`
     *
     * @return
     *      Returns the PHP `stream_get_meta_data()` array
     *      as a `MapArray`.
     */
    public function getMetadata(): MapArray;

    /**
     * Close the underlaying resource.
     */
    function close(): void;

    /**
     * Read and return the entire stream content
     *
     * @note
     *      Be aware that this could be a large portion of data.
     *
     * @return
     *      The entire content from this stream as a `string`.
     */
    function toString(): string;
}
