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

/**
 * Defines a stream resource with compression features.
 *
 * @note
 *      Any compression stream implementation must apply a specific header to the beginning of the stream.
 *
 *      |----------|------------------------------------|---------------------------|
 *      | 4 bytes  | \xBB\x8A\x8E\xAB                   | SQSync Signature          |
 *      | 2 bytes  |                                    | Algo Signature            |
 *      | 4 bytes  |                                    | Algo Reserved             |
 *      | 8 bytes  | \x00\x00\x00\x00\x00\x00\x00\x00   | Uncompressed Data length  |
 *      | 4 bytes  | \x00\x00\x00\x00                   | Additional header length  |
 *      | * bytes  |                                    | Additional header content |
 *
 *      The additional header can be set by using the `allocHeader()` and `writeHeader()` methods.
 */
interface CompressionStream extends Stream {

    /**
     * SQSync Signature
     */
    const SIGNATURE = "\xBB\x8A\x8E\xAB";

    /**
     * Read the additional header.
     */
    function readHeader(): ?string;

    /**
     * Write additional header to stream.
     *
     * @note
     *      You must allocate space for this header first.
     *
     * @param $header
     *      The additional header data
     */
    function writeHeader(string $header): bool;

    /**
     * Allocate space for additional header.
     *
     * @param $len
     *      Length to allocate for the additional header
     */
    function allocHeader(int $len): bool;

    /**
     * Get the name of the compression algorithm
     */
    function getAlgo(): string;

    /**
     * Get the signature of the compression algorithm
     */
    function getAlgoSig(): string;

    /**
     * Returns the uncompressed data length
     */
    function getRealLength(): int;
}
