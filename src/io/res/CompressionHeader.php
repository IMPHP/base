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

namespace im\io\res;

use RuntimeException;
use im\util\Struct;

/**
 * Internal helper class for `im\io\CompressionStream` implementations.
 *
 * This class is meant to help implementations of `CompressionStream`
 * to internally deal with header information. Each implementation
 * can easily make use of their own properties for this task.
 * This simply provides something that is ready to use.
 *
 * The class has several properties, each containing a `im\util\Struct` instance.
 * Each instance defines a portion of the SQSync header
 * and each instance has 3 initialized keys `offset`, `length` and `data`.
 *
 * The `offset` specifies the offset of that specific portion in the header,
 * the `length` is of cause the `length` of that portion along with the actual
 * `data` that portion contains. Some default data is pre-filled, but the idea is that
 * the implementations can fill in the data on class construct.
 *
 * @var int $length
 *      Readonly property that returns the total length
 *      of the header.
 */
class CompressionHeader {

    /**
     * Stores the SQSync signature.
     *
     * | Offset | Length | Data             |
     * |--------|--------|------------------|
     * | 0      | 4      | \xBB\x8A\x8E\xAB |
     */
    public Struct $bank1;

    /**
     * Stores the algorithm signature.
     *
     * | Offset | Length | Default Data     |
     * |--------|--------|------------------|
     * | 4      | 2      | \x00\x00         |
     */
    public Struct $bank2;

    /**
     * Stores the algorithm reserved space.
     *
     * | Offset | Length | Default Data     |
     * |--------|--------|------------------|
     * | 6      | 4      | \x00\x00\x00\x00 |
     */
    public Struct $bank3;

    /**
     * Stores the uncompressed content data length.
     *
     * | Offset | Length | Default Data                     |
     * |--------|--------|----------------------------------|
     * | 10     | 8      | \x00\x00\x00\x00\x00\x00\x00\x00 |
     */
    public Struct $bank4;

    /**
     * Stores the length of the additional header space.
     *
     * | Offset | Length | Default Data     |
     * |--------|--------|------------------|
     * | 18     | 4      | \x00\x00\x00\x00 |
     */
    public Struct $bank5;

    /**
     * Stores the additional header.
     *
     * | Offset | Length | Default Data     |
     * |--------|--------|------------------|
     * | 22     | 0      | \0               |
     */
    public Struct $bank6;

    /**
     *
     */
    public function __construct() {
        $this->bank1 = Struct::factory("offset", "length", "data");
        $this->bank1->fill(0, 4, "\xBB\x8A\x8E\xAB");

        $this->bank2 = Struct::factory("offset", "length", "data");
        $this->bank2->fill(4, 2, "\x00\x00");

        $this->bank3 = Struct::factory("offset", "length", "data");
        $this->bank3->fill(6, 4, "\x00\x00\x00\x00");

        $this->bank4 = Struct::factory("offset", "length", "data");
        $this->bank4->fill(10, 8, "\x00\x00\x00\x00\x00\x00\x00\x00");

        $this->bank5 = Struct::factory("offset", "length", "data");
        $this->bank5->fill(18, 4, "\x00\x00\x00\x00");

        $this->bank6 = Struct::factory("offset", "length", "data");
        $this->bank6->fill(22, 0, null);
    }

    /**
     * @ignore
     */
    public function __get(/*string*/ $name) /*mixed*/ {
        if ($name == "length") {
            return $this->bank6->offset + $this->bank6->length;
        }

        $trace = debug_backtrace();

        throw new RuntimeException(
            'Undefined property via '. get_class($this) .'__get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line']
        );
    }
}
