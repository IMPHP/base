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

/**
 * Base stream that implements some basics from the `Stream` interface.
 */
abstract class BaseStream implements Stream {

    /**
     *
     */
    public function __construct() {

    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function getResource() /*resource*/ {
        return StreamWrapper::getResource($this);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function isWritable(): bool {
        return $this->getFlags(Stream::F_WRITABLE) > 0;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function isReadable(): bool {
        return $this->getFlags(Stream::F_READABLE) > 0;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function isSeekable(): bool {
        return $this->getFlags(Stream::F_SEEKABLE) > 0;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    function getMode(): ?string {
        return $this->getMetadata()->get("mode");
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function getFlags(int $mask = 0): int {
        $meta = $this->getMetadata();

        $flags = 0;
        $flags |= preg_match(Stream::M_READABLE, $meta->get("mode")) ? Stream::F_READABLE : 0;
        $flags |= preg_match(Stream::M_WRITABLE, $meta->get("mode")) ? Stream::F_WRITABLE : 0;
        $flags |= ($meta->get("seekable", 0)) ? Stream::F_SEEKABLE : 0;

        return $mask != 0 ? $flags & $mask : $flags;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function getLength(): int {
        if ($this->getFlags(Stream::F_SEEKABLE) > 0) {
            $curpos = $this->getOffset();

            try {
                if ($this->seek(0, SEEK_END)) {
                    return $this->getOffset();
                }

            } finally {
                $this->seek($curpos);
            }
        }

        return -1;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function isEOF(): bool {
        $length = $this->getLength();
        $offset = $this->getOffset();

        return $length != -1 && $length == $offset;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function rewind(): bool {
        return $this->seek(0);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function writeFromStream(Stream $stream): int {
        $out = 0;

        while (($bytes = $stream->read(16384)) != null) {
            if (($writ = $this->write($bytes)) != strlen($bytes)) {
                return -1;
            }

            $out += $writ;
        }

        if ($bytes === null) {
            return -1;
        }

        return $out;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function allocate(int $length): bool {
        if ($this->getFlags(Stream::F_RWS) == Stream::F_RWS
                && strpos($this->getMode(), "a") === false) { // 'a' mode always writes to the end of the stream. Pointer is ignored.

            $offset = $this->getOffset();

            if ($this->seek(0, SEEK_END)) {
                $end = $this->getOffset();
                $range = $end - $offset;

                if ($this->write(str_repeat("\0", $length)) == -1) {
                    return false;
                }

                if ($range > 0) {
                    do {
                        $buflen = $range > 16384 ? 16384 : $range;
                        $this->seek( ($offset + $range) - $buflen );
                        $bytes = "";
                        $bytelen = 0;

                        while ($buflen > $bytelen && ($buff = $this->read($buflen - $bytelen)) != null) {
                            $bytes .= $buff;
                            $bytelen += strlen($buff);
                        }

                        if ($buff === null) {
                            return false;
                        }

                        $this->seek( ($offset + $range + $length) - $buflen );
                        $count = $this->write($bytes);
                        $range -= $buflen;

                        if ($bytelen != $count) {
                            return false;
                        }

                    } while ($range > 0);
                }

                $this->seek($offset);

                return true;
            }
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function clear(): bool {
        return $this->truncate(0);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function toString(): string {
        $output = "";
        $flags = $this->getFlags(Stream::F_RS);

        if ($flags == Stream::F_RS) {
            $offset = $this->getOffset();
            $this->rewind();

            while (($bytes = $this->read(16384)) != null) {
                $output .= $bytes;
            }

            $this->seek($offset);

        } else if (($flags & Stream::F_READABLE) > 0) {
            while (($bytes = $this->read(16384)) != null) {
                $output .= $bytes;
            }
        }

        return $output;
    }

    /**
     * @internal
     */
    public function __toString() {
        return $this->toString();
    }
}
