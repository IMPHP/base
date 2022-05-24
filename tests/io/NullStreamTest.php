<?php declare(strict_types=1);
/*
 * This file is part of the IMPHP Project: https://github.com/IMPHP
 *
 * Copyright (c) 2018 Daniel Bergløv, License: MIT
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
namespace im\test\io;

use im\io\Stream;
use im\io\NullStream;

/**
 *
 */
final class NullStreamTest extends StreamBase {

    /**
     *
     */
    public function initStream(): Stream {
        return new NullStream();
    }

    /**
     *
     */
    public function test_meta(): void {
        $stream = $this->initStream();

        $this->assertEquals(
            Stream::F_READABLE|Stream::F_WRITABLE,
            $stream->getFlags(Stream::F_READABLE|Stream::F_WRITABLE)
        );

        $stream->write(random_bytes(8192));
        $this->assertEquals(
            8192,
            $stream->getLength()
        );

        $stream->close();
    }

    /**
     *
     */
    public function test_offsets(): void {
        $stream = $this->initStream();

        $stream->write(random_bytes(8192));
        $this->assertEquals(
            8192,
            $stream->getOffset()
        );

        $stream->seek(512);
        $this->assertEquals(
            512,
            $stream->getOffset()
        );

        $stream->truncate(2048);
        $this->assertEquals(
            2048,
            $stream->getOffset()
        );

        $stream->seek(-2, SEEK_CUR);
        $this->assertEquals(
            2046,
            $stream->getOffset()
        );

        $stream->rewind();
        $this->assertEquals(
            0,
            $stream->getOffset()
        );

        $stream->close();
    }

    /**
     *
     */
    public function test_readWrite(): void {
        $stream = $this->initStream();

        $word = $stream->read(4);
        $this->assertEquals(
            4,
            strlen($word)
        );

        $this->assertEquals(
            "",
            (string) $stream
        );

        $stream->close();
    }

    /**
     *
     */
    public function test_allocation(): void {
        $stream = $this->initStream();
        $stream->write("StartEnd");
        $stream->seek(5);
        $stream->allocate(10);

        $this->assertEquals(
            5,
            $stream->getOffset()
        );

        $stream->close();
    }
}
