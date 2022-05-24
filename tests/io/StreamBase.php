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

use PHPUnit\Framework\TestCase;
use im\io\Stream;
use im\io\RawStream;

/**
 *
 */
abstract class StreamBase extends TestCase {

    /**
     *
     */
    abstract function initStream(): Stream;

    /**
     *
     */
    public function test_isSomethingable(): void {
        $stream = $this->initStream();

        $this->assertInstanceOf(
            Stream::class,
            $stream
        );

        $this->assertIsResource(
            $stream->getResource()
        );

        $this->assertTrue(
            $stream->isWritable()
        );

        $this->assertTrue(
            $stream->isReadable()
        );

        $this->assertTrue(
            $stream->isSeekable()
        );

        $stream->close();
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

        $stream->write(random_bytes(1024));
        $this->assertEquals(
            1024,
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

        while (($buffer = $stream->read(1024)) != null) {}
        $this->assertTrue(
            $stream->isEOF()
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
    public function test_write(): void {
        $stream2 = new RawStream();

        $res = $stream2->write(random_bytes(32728));
        $this->assertEquals(
            32728,
            $res
        );
        $stream2->rewind();

        $stream = $this->initStream();
        $res = $stream->writeFromStream($stream2);

        $this->assertEquals(
            32728,
            $res
        );

        $stream->close();
        $stream2->close();
    }

    /**
     *
     */
    public function test_readWrite(): void {
        $stream = $this->initStream();
        $stream->write("testLine 1\n");
        $stream->write("Line 2\n");
        $stream->write("Line 3");
        $stream->rewind();

        $word = $stream->read(4);
        $this->assertEquals(
            "test",
            $word
        );

        $i=1;
        while (($line = $stream->readline()) != null) {
            $this->assertEquals(
                "Line " . $i++ . ($i < 4 ? "\n" : ""),
                $line
            );
        }

        $this->assertEquals(
            "testLine 1\nLine 2\nLine 3",
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
            18,
            $stream->getLength()
        );

        $stream->rewind();
        $this->assertEquals(
            "Start",
            $stream->read(5)
        );

        $stream->seek(15);
        $this->assertEquals(
            "End",
            $stream->read(3)
        );

        $stream->close();
    }
}
