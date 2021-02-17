<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use im\io\Stream;
use im\io\RawStream;

final class RawStreamTest extends TestCase {

    /**
     *
     */
    public function test_isSomethingable(): Stream {
        $stream = new RawStream();

        $this->assertEquals(
            true,
            $stream->isWritable()
        );

        $this->assertEquals(
            true,
            $stream->isReadable()
        );

        $this->assertEquals(
            true,
            $stream->isSeekable()
        );

        return $stream;
    }

    /**
     * @depends test_isSomethingable
     */
    public function test_write(Stream $stream): Stream {
        $stream->write("Test Line");

        $this->assertEquals(
            "Test Line",
            $stream->toString()
        );

        return $stream;
    }

    /**
     * @depends test_write
     */
    public function test_read(Stream $stream): void {
        $stream->seek(0, SEEK_END);
        $stream->write("\n");
        $stream->rewind();

        while (($line = $stream->readLine()) !== null) {
            $this->assertEquals(
                "Test Line",
                $line
            );
        }
    }

    /**
     * @depends test_write
     */
    public function test_seek(Stream $stream): void {
        $stream->seek(5);

        $this->assertEquals(
            "Line",
            $stream->read(4)
        );
    }
}
