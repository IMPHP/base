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

use im\util\ImmutableMappedArray;
use im\util\Map;

/**
 * A string based Stream implementation.
 *
 * This `Stream` writes and reads data from a string.
 * Using `RawStream` with `php://temp` is the best option for temp storage,
 * but there may be situations where you have a string that you wish to read/write
 * in a particular way. This Stream also allows you to add a `string` by reference. 
 */
class StringStream extends BaseStream {

    /** @internal */
    protected int $flags = 0;

    /** @internal */
    protected string $mode = "";

    /** @internal */
    protected string $stream = "";

    /** @internal */
    protected int $pointer = 0;

    /** @internal */
    protected ImmutableMappedArray $meta;

    /**
     * @param $mode
     *      read/write modes.
     *      More information in the `fopen` function PHP documentation.
     */
    public function __construct(string $mode = Stream::DEF_MODE) {
        $this->mode = $mode;

        $this->flags |= preg_match(Stream::M_READABLE, $mode) ? Stream::F_READABLE : 0;
        $this->flags |= preg_match(Stream::M_WRITABLE, $mode) ? Stream::F_WRITABLE : 0;
        $this->flags |= Stream::F_SEEKABLE;

        $this->meta = new Map([
            "wrapper_type" => "PHP",
            "stream_type" => "TEMP",
            "mode" => $mode,
            "unread_bytes" => 0,
            "seekable" => 1,
            "uri" => "php://temp"
        ]);
    }

    /**
     * Attach a referenced string variable.
     *
     * This will replace the internal string used to store the string data.
     * Seen as this is a referenced argument, any changes made to this instance
     * will reflect the referenced string ouside of this scope.
     *
     * @note
     *      This is equal to opening a stream, meaning that the mode used to
     *      create the instance, will affect the referenced string. For an example if the mode
     *      is 'w' or 'w+', the referenced string will be truncated to 0 size.
     *      If the mode is 'a' or 'a+', the pointer is set to the end, although this only
     *      affects 'a+' when reading, since 'a' always appends written data.
     *
     * @param $stream
     *      A referenced string to replace the internal string variable.
     */
    public function attachStream(string &$stream): void {
        $this->stream = &$stream;

        if (strpos($this->mode, "w") !== false) {
            $this->stream = "";
            $this->pointer = 0;

        } else if (strpos($this->mode, "a") !== false) {
            $this->pointer = strlen($this->stream);
        }
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
    function getMode(): ?string {
        return $this->mode;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function getLength(): int {
        return strlen($this->stream);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function getOffset(): int {
        return $this->pointer;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function seek(int $offset, int $whence = SEEK_SET): bool {
        $max = strlen($this->stream);

        if ($whence == SEEK_CUR) {
            $offset += $this->pointer;

        } else if ($whence == SEEK_END) {
            $offset += $max;
        }

        if ($offset < 0 || $offset > $max) {
            return false;
        }

        $this->pointer = $offset;

        return true;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function truncate(int $size): bool {
        if (($this->flags & Stream::F_WRITABLE) > 0) {
            $curlen = strlen($this->stream);

            if ($size > $curlen) {
                $this->stream .= str_repeat("\0", $curlen - $size);

            } else {
                $this->stream = substr($this->stream, 0, $size);
            }

            $this->pointer = strlen($this->stream);

            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function close(): void {
        unset($this->stream); // We unset because it may be referenced
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function write(string $string, bool $expand = false): int {
        if (($this->flags & Stream::F_WRITABLE) > 0) {
            $len = strlen($string);

            if (strpos($this->mode, "a") !== false) { // a mode always writes to the end of stream
                $this->stream .= $string;

            } else {
                $this->stream = substr_replace($this->stream, $string, $this->pointer, $expand ? 0 : $len);
            }

            $this->pointer += $len;

            return $len;
        }

        return -1;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function read(int $length): ?string {
        if (($this->flags & Stream::F_READABLE) > 0) {
            $bytes = substr($this->stream, $this->pointer, $length);
            $this->pointer += strlen($bytes);

            return !empty($bytes) ? $bytes : "";
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function readLine(int $maxlen = -1): ?string {
        if (($this->flags & Stream::F_READABLE) > 0) {
            if (($pos = strpos($this->stream, "\r", $this->pointer)) !== false
                    || ($pos = strpos($this->stream, "\n", $this->pointer)) !== false) {

                $bytes = substr($this->stream, $this->pointer, $pos - $this->pointer);

                if (substr($this->stream, $pos, 2) == "\r\n") {
                    $this->pointer += (strlen($bytes) + 2);

                } else {
                    $this->pointer += (strlen($bytes) + 1);
                }

            } else {
                $bytes = substr($this->stream, $this->pointer);
                $this->pointer += strlen($bytes);
            }

            return !empty($bytes) ? $bytes : "";
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\io\Stream")]
    public function getMetadata(): ImmutableMappedArray {
        return $this->meta;
    }
}
