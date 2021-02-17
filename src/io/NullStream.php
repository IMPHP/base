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

use im\io\res\StreamDecorator;
use im\ErrorCatcher;

/**
 * A stream implementation that reads and writes to `NULL`.
 *
 * This is an unending stream that can be used mostly for testing purposes.
 * It can read bytes forever and anything written to it is disposed off, while acting as if it was written.
 *
 * This can be compared to `/dev/null` and `/dev/urandom` on Linux.
 *
 * @example
 *
 *      ```php
 *      $stream = new NullStream('+r'); // It will adhere to these rules
 *
 *      foreach (($bytes = $stream->read(4096)) !== null) { // Will run forever
 *          printf("%s\n", $bytes);
 *      }
 *
 *      // =================================
 *
 *      $wb = 0;
 *      do {
 *          $wb = $stream->write($bytes);   // Size never changes
 *
 *      } while ($wb > 0); // Will never break
 *
 *      // =================================
 *
 *      $len = $stream->getLength(); // Will return PHP_INT_MAX
 *      ```
 */
class NullStream implements Stream {

    use StreamDecorator;

    /**
     * @param $mode
     *      The stream mode to use.
     */
    public function __construct(string $mode = Stream::DEF_MODE) {
        $catcher = new ErrorCatcher();
        $res = $catcher->run(function() use ($mode) /*resource*/ {
            return fopen("php://temp", $mode);
        });

        if ($res == null) {
            throw $catcher->getException();
        }

        $this->stream = new RawStream($res);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\res\StreamDecorator")]
    public function getLength(): int {
        return $this->stream->getFlags() ? PHP_INT_MAX : -1;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\res\StreamDecorator")]
    public function isEOF(): bool {
        return $this->stream->getFlags() == 0;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\res\StreamDecorator")]
    public function getOffset(): int {
        return $this->stream->getFlags() ? 0 : -1;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\res\StreamDecorator")]
    public function seek(int $offset, int $whence = SEEK_SET): bool {
        return $this->stream->isSeekable();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\res\StreamDecorator")]
    public function rewind(): bool {
        return $this->stream->isSeekable();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\res\StreamDecorator")]
    public function write(string $string, bool $expand = false): int {
        if ($this->stream->isWritable() > 0) {
            // Repport a successful write
            return strlen($string);
        }

        return -1;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\res\StreamDecorator")]
    public function read(int $length): ?string {
        if ($this->stream->isReadable() > 0) {
            return random_bytes($length);
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\res\StreamDecorator")]
    public function readLine(int $maxlen = -1): ?string {
        if ($this->stream->isReadable() > 0) {
            return random_bytes($maxlen > 0 ? $maxlen : 4096);
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\res\StreamDecorator")]
    public function clear(): bool {
        return ($this->stream->getFlags() & Stream::F_WS) == F_WS;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\stream\res\StreamDecorator")]
    public function truncate(int $size): bool {
        return ($this->stream->getFlags() & Stream::F_WS) == F_WS;
    }
}
