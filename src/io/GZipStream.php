<?php declare(strict_types=1);
/*
 * This file is part of the IMPHP Project: https://github.com/IMPHP
 *
 * Copyright (c) 2021 Daniel Bergløv, License: MIT
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

use im\exc\StreamException;
use im\io\res\StreamDecorator;
use im\io\res\CompressionHeader;

/**
 * A CompressionStream that is backed by GZip DEFLATE
 *
 * This stream will compress and decompress all data that is
 * read from and written to the backing stream.
 *
 * @note
 *      This stream will add a header to the beginning of the stream.
 *
 *      |----------|------------------------------------|---------------------------|
 *      | 4 bytes  | \xBB\x8A\x8E\xAB                   | SQSync Signature          |
 *      | 2 bytes  | \x1F\x8B                           | GZip Signature            |
 *      | 4 bytes  | \x08\0\0\0                         | DEFLATE Signature         |
 *      | 8 bytes  | \x00\x00\x00\x00\x00\x00\x00\x00   | Data length               |
 *      | 4 bytes  | \x00\x00\x00\x00                   | Additional header length  |
 *
 *      The additional header can be set by using the `allocHeader()` and `writeHeader()` methods.
 *
 * @note
 *      The stream uses GZip as it's compression backend,
 *      but it does not produce GZip headers. Also it compresses
 *      data based on block chunks that are specific to this stream alone.
 *      You cannot use other GZip tools to decompress this data.
 */
class GZipStream implements CompressionStream {

    use StreamDecorator;

    /** @ignore */
    protected CompressionHeader $mHeader;

    /** @ignore */
    protected string $mBuffer = "";

    /**
     * Create a new instance of GZipStream.
     *
     * @note
     *      The backing `Stream` must be either readable or writable.
     *      It cannot be both.
     *
     * @note
     *      When adding a writable `Stream`, it will be truncated.
     *
     * @param $stream
     *      The backing stream to write to or read from.
     */
    public function __construct(Stream $stream) {
        if (($stream->isReadable() && $stream->isWritable())
              || (!$stream->isReadable() && !$stream->isWritable())) {

            throw new StreamException("Stream must be iether readable or writable");

        } else if ($stream->getOffset() > 0
                && !$stream->rewind()) {

            throw new StreamException("Failed to rewind stream");
        }

        $header = new CompressionHeader();
        $header->bank2->data = "\x1F\x8B";         // GZip format
        $header->bank3->data = "\x08\0\0\0";       // DEFLATE compression

        if ($stream->isReadable()) {
            $bytes = $stream->read($header->length);    // Read header and seek to the begining of the actual file content

            if (strlen($bytes) != $header->length
                  || substr($bytes, 0, 4) != $header->bank1->data
                  || substr($bytes, 4, 2) != $header->bank2->data) {

                $stream->rewind();

                throw new StreamException("Invalid signature");
            }

            $header->bank4->data = unpack("J", substr($bytes, 10, 8))[1];
            $header->bank5->data = unpack("N", substr($bytes, 18, 4))[1];

            if ($header->bank5->data > 0) {
                $header->bank6->data = $stream->read($header->bank5->data);
                $header->bank6->length = $header->bank5->data;
            }

        } else {
            $stream->truncate(0);
            $stream->write($header->bank1->data);
            $stream->write($header->bank2->data);
            $stream->write($header->bank3->data);
            $stream->write($header->bank4->data);
            $stream->write($header->bank5->data);

            $header->bank4->data = 0;
            $header->bank5->data = 0;
        }

        $this->stream = $stream;
        $this->mHeader = $header;
    }

    /**
     * @inheritDoc
     */
    #[Override("sqsync\io\CompressionStream")]
    public function getAlgo(): string {
        return "gzip";
    }

    /**
     * @inheritDoc
     */
    #[Override("sqsync\io\CompressionStream")]
    function getAlgoSig(): string {
        return $this->mHeader->bank2->data;
    }

    /**
     * @inheritDoc
     */
    #[Override("sqsync\io\CompressionStream")]
    function allocHeader(int $len): bool {
        $header = $this->mHeader;

        if ($header->bank6->length < $len) {
            if (!$this->stream->isSeekable()
                    || !$this->stream->isWritable()) {

                throw new StreamException("Header cannot be allocated on this stream");
            }

            $offset = $this->stream->getOffset();

            if ($offset >= $header->length) {
                $offset += ($len - $header->bank6->length);
            }

            if (!$this->stream->seek($header->bank5->offset)
                    || !$this->stream->write(pack("N", $len))
                    || !$this->stream->seek($header->bank6->offset + $header->bank6->length)
                    || !$this->stream->write(str_repeat("\0", $len - $header->bank6->length), true)) {

                throw new StreamException("Failed to allocate header");
            }

            $header->bank6->length = $len;

            $this->stream->seek($offset);
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    #[Override("sqsync\io\CompressionStream")]
    public function getRealLength(): int {
        return $this->mHeader->bank4->data;
    }

    /**
     * @inheritDoc
     */
    #[Override("sqsync\io\CompressionStream")]
    public function readHeader(): ?string {
        $header = $this->mHeader;

        if ($header->bank6->length == 0) {
            return null;
        }

        return $header->bank6->data;
    }

    /**
     * @inheritDoc
     */
    #[Override("sqsync\io\CompressionStream")]
    public function writeHeader(string $bytes): bool {
        $header = $this->mHeader;

        if (!$this->stream->isSeekable()
                || !$this->stream->isWritable()) {

            throw new StreamException("Header cannot be written to this stream");

        } else if ($header->bank6->length < strlen($bytes)) {
            throw new StreamException("Header allocation is to small");
        }

        $offset = $this->stream->getOffset();

        return $this->stream->seek($header->bank6->offset)
                && $this->stream->write($bytes)
                && $this->stream->seek($offset);
    }

    /**
     * Close this stream.
     *
     * @note
     *      Remaining headers such as the uncompressed data length
     *      will be written to the stream before closing it.
     *      Failing to call this method before destructing the instance
     *      will result in some header loss.
     *
     * @param $keepAlive
     *      Only write headers to stream and finalize this instance.
     *      Do not close the backing stream.
     */
    #[Override("im\io\res\StreamDecorator")]
    public function close(bool $keepAlive = FALSE): void {
        if ($this->stream->isSeekable()
                && $this->stream->isWritable()) {

            $header = $this->mHeader;

            $this->stream->seek($header->bank4->offset);
            $this->stream->write(pack("J", $header->bank4->data));
        }

        if (!$keepAlive) {
            $this->stream->close();
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\res\StreamDecorator")]
    public function getFlags(): int {
        $flags = $this->stream->getFlags();
        $flags |= ~Stream::F_SEEKABLE; // Remove seekable flag

        return $flags;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\res\StreamDecorator")]
    public function isSeekable(): bool {
        return false;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\res\StreamDecorator")]
    public function getLength(bool $uncompressed = FALSE): int {
        $header = $this->mHeader;

        if ($uncompressed) {
            return $header->bank4->data;
        }

        return $this->stream->getLength() - $header->length;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\res\StreamDecorator")]
    public function getOffset(): int {
        return $this->stream->getOffset() - $this->mHeader->length - strlen($this->mBuffer);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\res\StreamDecorator")]
    public function isEOF(): bool {
        return strlen($this->mBuffer) == 0
                    && $this->stream->isEOF();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\res\StreamDecorator")]
    public function seek(int $offset, int $whence = SEEK_SET): bool {
        throw new StreamException("Feature is not supported by this stream");
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\res\StreamDecorator")]
    public function rewind(): bool {
        if ($this->stream->rewind()
                || $this->stream->seek($this->mHeader->length)) {

            $this->mBuffer = "";

            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\res\StreamDecorator")]
    public function clear(): bool {
        $header = $this->mHeader;

        if ($this->stream->ftruncate($header->length)) {

            $this->mBuffer = "";
            $header->bank4->data = 0;

            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\res\StreamDecorator")]
    public function truncate(int $size): bool {
        throw new StreamException("Feature is not supported by this stream");
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\res\StreamDecorator")]
    public function write(string $string, bool $expand = false): int {
        $header = $this->mHeader;
        $realen = strlen($string);
        $string = gzcompress($string, 9);
        $newlen = strlen($string);

        $bytes = $this->stream->write(
              pack("N", $newlen) . $string,
              $expand
        );

        if ($bytes < 0) {
            return -1;

        } else if ($bytes - 4 != $newlen) { // Subtract 4 bytes (block size header)
            /*
             * This is nowhere correct.
             * We are estimating how much of the real
             * bytes was written in compressed form based on percentage.
             * But compression does not exactly work like this,
             * but it does not really matter. There is no way to
             * fix half of this block anyway, without rewriting
             * the entire original block. We just have to report
             * something that is close to the actual write status.
             */
            $percent = ($bytes - 4) / $newlen;
            $realen = intval($realen * $percent);
        }

        $header->bank4->data += $realen;

        return $realen;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\res\StreamDecorator")]
    public function read(int $length): ?string {
        while (($buflen = strlen($this->mBuffer)) < $length) {
            $blksize = $this->stream->read(4);

            if ($blksize === null || strlen($blksize) < 4) {
                break;

            } else {
                $blksize = unpack("N", $blksize)[1];
            }

            $this->mBuffer .= gzuncompress($this->stream->read($blksize));
        }

        if ($buflen == 0) {
            return null;
        }

        $block = substr($this->mBuffer, 0, $length);
        $this->mBuffer = substr($this->mBuffer, $length);

        return $block;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\res\StreamDecorator")]
    public function readLine(int $maxlen = -1): ?string {
        // TODO: Implement
        throw new StreamException("Feature is not supported by this stream");
    }
}
