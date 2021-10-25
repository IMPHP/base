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

use im\exc\StreamException;
use const SEEK_SET;

/*
 * Register this wrapper
 */
stream_wrapper_register(StreamWrapper::NAME, StreamWrapper::class);

/**
 * Stream wrapper that is used to convert a Stream
 * into a valid PHP resource.
 *
 * Do not create instances of this class.
 * It's unofficially part of a StreamWrapper Interface,
 * that does not exist, and is used internaly by PHP.
 *
 * You can use `StreamWrapper::getResource()` to get a
 * resource that is using a Stream underneath. You can also
 * just use `Stream::getResource()`.
 *
 * @internal
 */
class StreamWrapper /* implements \StreamWrapper */ {

    /**
     * The stream wrapper name that is registered to the system.
     *
     * @var string
     */
    const /*string*/ NAME = "imphp";

    /**
     * @internal
     * @php
     */
    public /*?resource*/ $context; // Updated by PHP

    /** @internal */
    protected ?Stream $mStream;

    /**
     * Get a context that can be used when creating a resource from a Stream
     *
     * @internal
     */
    public static function getContext(Stream $stream) /*resource*/ {
        return stream_context_create([static::NAME => ["stream" => $stream]]);
    }

    /**
     * Convert a Stream into a valid PHP Resource.
     *
     * @param $stream
     *      The stream to convert.
     *
     * @return resource
     *      A PHP resource wrapper.
     */
    public static function getResource(Stream $stream) /*resource*/ {
        $context = StreamWrapper::getContext($stream);
        $mode = match ( $stream->getFlags() & Stream::F_RW ) {
                    Stream::F_RW => 'r+',
                    Stream::F_READABLE => "r",
                    Stream::F_WRITABLE => "w"
                };

        if ($mode == null) {
            throw new StreamException("The stream is not active");
        }

        return fopen(StreamWrapper::NAME.'://stream', $mode, false, $context);
    }

    /**
     * @internal
     * @php
     */
    public function stream_open(string $path, string $mode, int $options, string &$opened_path = null): bool {
        $context = stream_context_get_options($this->context);

        if (!isset($context[StreamWrapper::NAME]["stream"])) {
            return false;
        }

        $this->mStream = $context[StreamWrapper::NAME]["stream"];

        return true;
    }

    /**
     * @internal
     * @php
     */
    public function stream_close(): void {
        $this->mStream->close();
    }

    /**
     * @internal
     * @php
     */
    public function stream_write(string $data): int {
        $ret = $this->mStream->write($data);

        if ($ret < 0) {
            return 0;
        }

        return $ret;
    }

    /**
     * @internal
     * @php
     */
    public function stream_read(int $count): string {
        return $this->mStream->read($count) ?? "";
    }

    /**
     * @internal
     * @php
     */
    public function stream_eof(): bool {
        return $this->mStream->isEOF();
    }

    /**
     * @internal
     * @php
     */
    public function stream_tell(): int {
        $ret = $this->mStream->getOffset();

        if ($ret < 0) {
            return 0;
        }

        return $ret;
    }

    /**
     * @internal
     * @php
     */
    public function stream_seek(int $offset , int $whence = SEEK_SET): bool {
        return $this->mStream->seek($offset, $whence);
    }

    /**
     * @internal
     * @php
     */
    public function stream_truncate(int $new_size): bool {
        return $this->mStream->truncate($new_size);
    }

    /**
     * @internal
     * @php
     */
    public function stream_stat(): array {
        $flags = $this->mStream->getFlags();

        /* PHP documentation recomments specifying all
         * parts, even those with '0' value
         */
        return [
            "dev" => 0,
            "ino" => 0,
            "mode" =>   match ( $flags & Stream::F_RW ) {
                            Stream::F_RW => 33206,
                            Stream::F_READABLE => 33060,
                            Stream::F_WRITABLE => 33188
                        },

            "nlink" => 0,
            "uid" => 0,
            "gid" => 0,
            "rdev" => 0,
            "size" =>   $flags == 0 ? 0 : $this->mStream->getLength(),
            "atime" => 0,
            "mtime" => 0,
            "ctime" => 0,
            "blksize" => 0,
            "blocks" => 0
         ];
    }

    /**
     * @internal
     * @php
     */
    public function url_stat(): array {
        /* PHP documentation recomments specifying all
         * parts, even those with '0' value
         */
        return [
            "dev" => 0,
            "ino" => 0,
            "mode" => 0,
            "nlink" => 0,
            "uid" => 0,
            "gid" => 0,
            "rdev" => 0,
            "size" => 0,
            "atime" => 0,
            "mtime" => 0,
            "ctime" => 0,
            "blksize" => 0,
            "blocks" => 0
         ];
    }
}
