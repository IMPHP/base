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
    protected /*resource*/ $mResource;

    /** @internal */
    protected int $mFlags = 0;

    /** @internal */
    protected ?string $mMode;

    /** @internal */
    protected array $mMeta;

    /** @internal */
    protected ErrorCatcher $mCatcher;

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

        $this->mFlags |= preg_match(Stream::M_READABLE, $meta["mode"]) ? Stream::F_READABLE : 0;
        $this->mFlags |= preg_match(Stream::M_WRITABLE, $meta["mode"]) ? Stream::F_WRITABLE : 0;
        $this->mFlags |= $meta["seekable"] ? Stream::F_SEEKABLE : 0;
        $this->mResource = $res;
        $this->mMeta = $meta;
        $this->mMode = $meta["mode"];
        $this->mCatcher = new ErrorCatcher(FALSE);
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
        return $this->mFlags;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    function getMode(): ?string {
        return $this->mMode;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function isWritable(): bool {
        return ($this->mFlags & Stream::F_WRITABLE) > 0;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function isReadable(): bool {
        return ($this->mFlags & Stream::F_READABLE) > 0;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function isSeekable(): bool {
        return ($this->mFlags & Stream::F_SEEKABLE) > 0;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function getLength(): int {
        if ($this->mFlags > 0) {
            if (!empty($this->mMeta["uri"])) {
                clearstatcache(true, $this->mMeta["uri"]);
            }

            $stat = fstat($this->mResource);

            if (is_array($stat)) {
                return fstat($this->mResource)["size"] ?? -1;
            }
        }

        return -1;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function getOffset(): int {
        if ($this->mFlags > 0) {
            $pos = ftell($this->mResource);

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
        if ($this->mFlags > 0) {
            return feof($this->mResource);
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function seek(int $offset, int $whence = SEEK_SET): bool {
        if ($this->mFlags & Stream::F_SEEKABLE) {
            if ($offset < 0 && $whence == SEEK_SET) {
                $whence = SEEK_END;
            }

            return fseek($this->mResource, $offset, $whence) == 0;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function rewind(): bool {
        if ($this->mFlags & Stream::F_SEEKABLE) {
            return rewind($this->mResource);
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function writeFromStream(Stream $stream): int {
        if ($stream->getFlags() & Stream::F_READABLE
                && $this->mFlags & Stream::F_WRITABLE) {

            $source = $stream->getResource();
            $target = $this->mResource;
            $bytes = $this->mCatcher->run(function() use ($resource, $source) {
                return stream_copy_to_stream($source, $target);
            });

            if ($this->mCatcher->getException() != null) {
                throw $this->mCatcher->getException();

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
        if ($this->mFlags & Stream::F_WRITABLE) {
            $resource = $this->mResource;
            $bytes = -1;

            if (!$expand) {
                $bytes = $this->mCatcher->run(function() use ($resource, &$string) {
                    return fwrite($this->mResource, $string);
                });

            } else if ($this->mFlags & Stream::F_SEEKABLE
                        && $this->mFlags & Stream::F_READABLE) {

                $bytes = $this->mCatcher->run(function() use ($resource, &$string) {
                    $pos = ftell($this->mResource);
                    $tmpres = fopen('php://temp', 'r+');

                    if (is_resource($tmpres)
                            && stream_copy_to_stream($this->mResource, $tmpres) !== FALSE) {

                        fseek($this->mResource, $pos, SEEK_SET);
                        fseek($tmpres, 0, SEEK_SET);

                        $bytes = fwrite($this->mResource, $string);

                        try {
                            if ($bytes !== false) {
                                stream_copy_to_stream($tmpres, $this->mResource);

                                return $bytes;
                            }

                        } finally {
                            fclose($tmpres);
                        }
                    }

                    return -1;
                });
            }

            if ($this->mCatcher->getException() != null) {
                throw $this->mCatcher->getException();

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
        if ($this->mFlags & Stream::F_READABLE) {
            $resource = $this->mResource;

            do {
                $data = $this->mCatcher->run(function() use ($resource, $length) {
                    $data = fread($resource, $length);

                    if (!empty($data)) {
                        return $data;
                    }

                    return null;
                });

                if ($data != null) {
                    break;
                }

            } while (!feof($this->mResource));

            if ($this->mCatcher->getException() != null) {
                throw $this->mCatcher->getException();
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
        if ($this->mFlags & Stream::F_READABLE) {
            $resource = $this->mResource;

            do {
                $data = $this->mCatcher->run(function() use ($resource, $maxlen) {
                    $data = fgets($resource, $maxlen > 0 ? $maxlen : null);

                    if (!empty($data)) {
                        return $data;
                    }

                    return null;
                });

                if ($data != null) {
                    break;
                }

            } while (!feof($this->mResource));

            if ($this->mCatcher->getException() != null) {
                throw $this->mCatcher->getException();
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
        if (($this->mFlags & Stream::F_WS) == Stream::F_WS) {
            return ftruncate($this->mResource, 0)
                    && rewind($this->mResource);
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function truncate(int $size): bool {
        if (($this->mFlags & Stream::F_WS) == Stream::F_WS) {
            return ftruncate($this->mResource, $size)
                    && fseek($this->mResource, 0, SEEK_END);
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function close(): void {
        if ($this->mFlags > 0) {
            $resource = $this->mResource;
            $this->mCatcher->run(function() use ($resource) {
                if (!fclose($resource)) {
                    // Pipe Resource
                    pclose($resource);
                }
            });

            $this->mFlags = 0;
            $this->mMeta = [];
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function getMetadata(): MapArray {
        return new Map( $this->mMeta );
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function toString(): string {
        if ($this->mFlags > 0) {
            if (($this->mFlags & Stream::F_RS) == Stream::F_RS) {
                rewind($this->mResource);

                $content = stream_get_contents($this->mResource);

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
