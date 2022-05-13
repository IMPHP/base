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

use im\util\Map;
use im\util\MapArray;
use im\exc\StreamException;
use im\ErrorCatcher;

use const SEEK_SET;
use const SEEK_END;

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
class RawStream implements Stream {

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
        if ($res == null) {
            $res = fopen('php://temp', 'r+');

        } else if (!is_resource($res)) {
            throw new StreamException("Invalid type. Must be of the type 'resource'");
        }

        $meta = stream_get_meta_data($res);

        $this->flags |= preg_match(Stream::M_READABLE, $meta["mode"]) ? Stream::F_READABLE : 0;
        $this->flags |= preg_match(Stream::M_WRITABLE, $meta["mode"]) ? Stream::F_WRITABLE : 0;
        $this->flags |= $meta["seekable"] ? Stream::F_SEEKABLE : 0;

        $this->catcher = new ErrorCatcher(FALSE);
        $this->resource = $res;
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
    public function getFlags(): int {
        return $this->flags;
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
    public function isWritable(): bool {
        return ($this->flags & Stream::F_WRITABLE) > 0;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function isReadable(): bool {
        return ($this->flags & Stream::F_READABLE) > 0;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function isSeekable(): bool {
        return ($this->flags & Stream::F_SEEKABLE) > 0;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
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
                if ($this->flags & Stream::F_SEEKABLE) {
                    $curpos = $this->getOffset();

                    try {
                        if ($this->seek(0, SEEK_END)) {
                            return $this->getOffset();
                        }

                    } finally {
                        $this->seek($curpos);
                    }
                }
            }
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
    #[Override("im\io\Stream")]
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
    public function rewind(): bool {
        return $this->seek(0);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function writeFromStream(Stream $stream): int {
        if ($stream->getFlags() & Stream::F_READABLE
                && $this->flags & Stream::F_WRITABLE) {

            $source = $stream->getResource();
            $target = $this->resource;
            $bytes = $this->catcher->run(function() use ($resource, $source) {
                return stream_copy_to_stream($source, $target);
            });

            if ($this->catcher->getException() != null) {
                throw $this->catcher->getException();

            } else if ($bytes !== false) {
                return $bytes;
            }
        }

        return -1;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function write(string $string, bool $expand = false): int {
        if ($this->flags & Stream::F_WRITABLE) {
            $resource = $this->resource;
            $bytes = -1;

            if (!$expand) {
                $bytes = $this->catcher->run(function() use ($resource, &$string) {
                    return fwrite($this->resource, $string);
                });

            } else if ($this->flags & Stream::F_SEEKABLE
                        && $this->flags & Stream::F_READABLE) {

                $bytes = $this->catcher->run(function() use ($resource, &$string) {
                    $pos = ftell($this->resource);
                    $tmpres = fopen('php://temp', 'r+');

                    if (is_resource($tmpres)
                            && stream_copy_to_stream($this->resource, $tmpres) !== FALSE) {

                        fseek($this->resource, $pos, SEEK_SET);
                        fseek($tmpres, 0, SEEK_SET);

                        $bytes = fwrite($this->resource, $string);

                        try {
                            if ($bytes !== false) {
                                stream_copy_to_stream($tmpres, $this->resource);

                                return $bytes;
                            }

                        } finally {
                            fclose($tmpres);
                        }
                    }

                    return -1;
                });
            }

            if ($this->catcher->getException() != null) {
                throw $this->catcher->getException();

            } else if ($bytes !== false) {
                return $bytes;
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

            do {
                $data = $this->catcher->run(function() use ($resource, $length) {
                    $data = fread($resource, $length);

                    if (!empty($data)) {
                        return $data;
                    }

                    return null;
                });

                if ($data != null) {
                    break;
                }

            } while (!feof($this->resource));

            if ($this->catcher->getException() != null) {
                throw $this->catcher->getException();
            }

            return $data;
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

            do {
                $data = $this->catcher->run(function() use ($resource, $maxlen) {
                    $data = fgets($resource, $maxlen > 0 ? $maxlen : null);

                    if (!empty($data)) {
                        return $data;
                    }

                    return null;
                });

                if ($data != null) {
                    break;
                }

            } while (!feof($this->resource));

            if ($this->catcher->getException() != null) {
                throw $this->catcher->getException();
            }

            if ($data != null) {
                return strrpos($data, "\n", -1) !== false ? substr($data, 0, -1) : $data;
            }
        }

        return null;
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
    public function getMetadata(): MapArray {
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
    public function toString(): string {
        if ($this->flags > 0) {
            if (($this->flags & Stream::F_RS) == Stream::F_RS) {
                rewind($this->resource);

                $content = stream_get_contents($this->resource);

                if ($content !== false) {
                    return $content;
                }
            }
        }

        return "";
    }

    /**
     * @internal
     * @php
     */
    public function __toString() {
        return $this->toString();
    }
}
