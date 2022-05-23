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

use Throwable;
use im\ErrorCatcher;
use im\exc\StreamException;
use im\util\ImmutableMappedArray;
use im\util\Map;

/**
 * A stream implementation that wrappes a PHP `resource`.
 *
 * @example
 *
 *      ```php
 *      $stream = new RawStream( fopen($path, 'r+') );
 *
 *      foreach (($line = $stream->readLine()) !== null) {
 *          printf("%s\n", $line);
 *      }
 *
 *      $stream->close();
 *      ```
 */
class RawStream extends BaseStream {

    /** @internal */
    protected /*resource*/ $resource;

    /** @internal */
    protected int $flags = 0;

    /** @internal */
    protected ErrorCatcher $catcher;

    /**
     * @param resource $res
     *      A PHP resource to use.
     */
    public function __construct(/*resource*/ $res = null) {
        parent::__construct();

        if ($res === null) {
            $res = fopen('php://temp', 'r+');

        } else if (!is_resource($res)) {
            throw new StreamException("Invalid type. Must be of the type 'resource'");
        }

        $meta = stream_get_meta_data($res);

        $this->flags |= preg_match(Stream::M_READABLE, $meta["mode"]) ? Stream::F_READABLE : 0;
        $this->flags |= preg_match(Stream::M_WRITABLE, $meta["mode"]) ? Stream::F_WRITABLE : 0;
        $this->flags |= ($meta["seekable"] ?? 0) ? Stream::F_SEEKABLE : 0;

        $this->catcher = new ErrorCatcher(ErrorCatcher::T_HALT|ErrorCatcher::T_THROW);
        $this->resource = $res;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\BaseStream")]
    public function getFlags(int $mask = 0): int {
        return $mask != 0 ? $this->flags & $mask : $this->flags;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\BaseStream")]
    public function getLength(): int {
        if ($this->flags > 0) {
            $meta = $this->getMetadata();
            $resource = $this->resource;
            $length = $this->catcher->run(function() use ($meta, $resource) {
                if ($meta->isset("uri")) {
                    clearstatcache(true, $meta->get("uri"));
                }

                $stat = fstat($resource);

                if (is_array($stat)) {
                    return fstat($resource)["size"] ?? -1;
                }

                return -1;
            });

            if ($length == -1) {
                return parent::getLength();
            }

            return $length;
        }

        return -1;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function getOffset(): int {
        if ($this->flags > 0) {
            $resource = $this->resource;
            $pos = $this->catcher->run(function() use ($resource) {
                return ftell($this->resource);
            });

            if ($pos !== false) {
                return $pos;
            }
        }

        return -1;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\BaseStream")]
    public function isEOF(): bool {
        if ($this->flags > 0) {
            $resource = $this->resource;
            $eof = $this->catcher->run(function() use ($resource) {
                return feof($this->resource);
            });

            return $eof;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function seek(int $offset, int $whence = SEEK_SET): bool {
        if ($this->flags & Stream::F_SEEKABLE) {
            if ($offset < 0 && $whence == SEEK_SET) {
                $whence = SEEK_END;
            }

            $resource = $this->resource;
            $seek = $this->catcher->run(function() use ($resource, $offset, $whence) {
                return fseek($resource, $offset, $whence);
            });

            if ($seek == 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function truncate(int $size): bool {
        if (($this->flags & Stream::F_WS) == Stream::F_WS) {
            $resource = $this->resource;

            return $this->catcher->run(function() use ($resource, $size) {
                return ftruncate($this->resource, $size)
                        && fseek($this->resource, 0, SEEK_END) == 0;
            });
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function close(): void {
        if ($this->flags > 0) {
            $resource = $this->resource;

            try {
                $this->catcher->run(function() use ($resource) {
                    if (!fclose($resource)) {
                        // Pipe Resource
                        pclose($resource);
                    }
                });

            } catch (Throwable $e) {}

            $this->flags = 0;
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function getMetadata(): ImmutableMappedArray {
        if ($this->flags > 0) {
            $resource = $this->resource;
            $meta = $this->catcher->run(function() use ($resource) {
                return stream_get_meta_data($this->resource);
            });

            if (is_array($meta)) {
                return new Map($meta);
            }
        }

        return new Map();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function write(string $string, bool $expand = false): int {
        if ($this->flags & Stream::F_WRITABLE) {
            if ($expand && !$this->allocate(strlen($string))) {
                return -1;
            }

            $resource = $this->resource;
            $count = $this->catcher->run(function() use ($string, $resource) {
                return fwrite($this->resource, $string);
            });

            if ($count !== false) {
                return $count;
            }
        }

        return -1;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function read(int $length): ?string {
        if ($this->flags & Stream::F_READABLE) {
            $resource = $this->resource;
            $bytes = $this->catcher->run(function() use ($length, $resource) {
                return fread($resource, $length);
            });

            if ($bytes !== false) {
                return empty($bytes) ? "" : $bytes;
            }
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function readLine(int $maxlen = -1): ?string {
        if ($this->flags & Stream::F_READABLE) {
            $resource = $this->resource;
            $bytes = $this->catcher->run(function() use ($maxlen, $resource) {
                return fgets($resource, $maxlen > 0 ? $maxlen : null);
            });

            if ($bytes !== false || $this->isEOF()) { // fgets may return false on both error and eof.
                return ($bytes === false || empty($bytes)) ? "" : str_replace(["\r\n", "\n", "\r"], PHP_EOL, $bytes);
            }
        }

        return null;
    }
}
