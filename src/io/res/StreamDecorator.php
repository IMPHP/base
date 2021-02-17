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

namespace im\io\res;

use im\util\Map;
use im\io\Stream;
use im\io\StreamWrapper;

/**
 * Provides implementation for `im\io\Stream`.
 *
 * This can be used to easily create abstractions for `Stream` objects.
 * It provides all the implementation from `im\io\Stream` and redirects it to
 * an underlaying `im\io\Stream` instance via `$this->stream`.
 *
 * @example
 *
 *      ```php
 *      class MyStream implements Stream {
 *          use StreamDecorator;
 *
 *          public function __construct(Stream $stream) {
 *              $this->stream = $stream;
 *          }
 *
 *          public function write(string $string, bool $expand = false): int {
 *              // Extend and change the behavior of this particular method
 *          }
 *      }
 *      ```
 *
 * @var im\io\Stream $stream
 *      Property used by this Trait to access the underlaying `Stream`.
 *      This is just a reference property and not really defined within this trait.
 *      How this is implemented is up to the implementing class.
 */
trait StreamDecorator {

    /**
     * @inheritDoc
     */
    #[Override("im\stream\Stream")]
    public function getResource() /*resource*/ {
        return StreamWrapper::getResource($this);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\Stream")]
    public function getFlags(): int {
        return $this->stream->getFlags();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\Stream")]
    function getMode(): ?string {
        return $this->stream->getMode();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\Stream")]
    public function isWritable(): bool {
        return $this->stream->isWritable();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\Stream")]
    public function isReadable(): bool {
        return $this->stream->isReadable();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\Stream")]
    public function isSeekable(): bool {
        return $this->stream->isSeekable();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\Stream")]
    public function getLength(): int {
        return $this->stream->getLength();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\Stream")]
    public function getOffset(): int {
        return $this->stream->getOffset();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\Stream")]
    public function isEOF(): bool {
        return $this->stream->isEOF();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\Stream")]
    public function seek(int $offset, int $whence = SEEK_SET): bool {
        return $this->stream->seek($offset, $whence);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\Stream")]
    public function rewind(): bool {
        return $this->stream->rewind();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\Stream")]
    public function writeFromStream(Stream $stream): int {
        return $this->stream->writeFromStream($stream);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\Stream")]
    public function write(string $string, bool $expand = false): int {
        return $this->stream->write($string, $expand);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\Stream")]
    public function read(int $length): ?string {
        return $this->stream->read($length);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\Stream")]
    public function readLine(int $maxlen = -1): ?string {
        return $this->stream->readLine($maxlen);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\Stream")]
    public function clear(): bool {
        return $this->stream->clear();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\Stream")]
    public function truncate(int $size): bool {
        return $this->stream->truncate($size);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\Stream")]
    public function getMetadata(): Map {
        return $this->stream->getMetadata();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\Stream")]
    public function close(): void {
        $this->stream->close();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\Stream")]
    public function toString(): string {
        return $this->stream->toString();
    }

    /**
     * @internal
     * @php
     */
    public function __toString() {
        return $this->toString();
    }
}
