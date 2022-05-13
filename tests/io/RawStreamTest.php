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
        $stream->write("Test Line 1");

        $this->assertEquals(
            "Test Line 1",
            $stream->toString()
        );

        return $stream;
    }

    /**
     * @depends test_seek
     */
    public function test_read(Stream $stream): Stream {
        $stream->seek(0, SEEK_END);
        $stream->write("\n");
        $stream->rewind();

        while (($line = $stream->readLine()) != null) {
            $this->assertEquals(
                "Test Line 1",
                $line
            );
        }

        return $stream;
    }

    /**
     * @depends test_write
     */
    public function test_seek(Stream $stream): Stream {
        $stream->seek(5);

        $this->assertEquals(
            "Line",
            $stream->read(4)
        );

        return $stream;
    }

    /**
     * @depends test_read
     */
    public function test_expand(Stream $stream): void {
        $pos = $stream->getOffset();

        $stream->write("Test Line 2\n");
        $stream->seek($pos);

        $stream->write("Test Line 3\n", true);
        $stream->rewind();

        foreach ([1,3,2] as $num) {
            $this->assertEquals(
                "Test Line $num",
                $stream->readLine()
            );
        }
    }
}
