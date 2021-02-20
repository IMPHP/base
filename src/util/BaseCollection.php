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

namespace im\util;

use im\util\res\DataTable;
use im\util\res\LockTable;
use Traversable;

/**
 * An abstract implementation of the `Collection` interface.
 */
abstract class BaseCollection implements Collection {

    /** @ignore */
    protected DataTable $mData;

    /**
     * Combine two arrays recursively
     *
     * This is similar to `array_merge_recursive()`, but this method
     * does not alter the structure. For example if you combine an array with
     * the same key containing a string, you do not get an indexed array containing
     * two strings. The second string will replace the first one. Indexed arrays
     * however are merged normally.
     *
     * @param $array1
     *      First array which will have second priority
     *
     * @param $array2
     *      Second array which will have first priority
     *
     * @return
     *      A new array containing the merged data
     */
    public static function combineArrays(array &$array1, array &$array2): array {
        $merged = $array1;

        foreach ($array2 as $key => &$value) {
            if (!is_int($key) && is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                $merged[$key] = static::combineArrays($merged[$key], $value);

            } else if (is_int($key)) {
                $merged[] = $value;

            } else {
                $merged[$key] = $value;
            }
        }

        return $merged;
    }

    /**
     *
     */
    public function __construct() {
        $this->mData = $this->createDataTable();
    }

    /**
     * @internal
     */
    protected function createDataTable(): DataTable {
        return new class() extends LockTable {};
    }

    /**
     * Lock the dataset to make it immutable.
     */
    function lock(): void {
        $this->mData->transaction(LockTable::T_LCK);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    function clear(): void {
        $this->mData->transaction(DataTable::T_CLR);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    function length(): int {
        return $this->mData->transaction(DataTable::T_LEN);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    function toArray(): array {
        $array = [];

        foreach ($this->mData as $key => $value) {
            $array[$key] = $value;
        }

        return $array;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    function copy(callable $sort = null): static {
        $new = clone $this;

        if ($sort != null) {
            $new->mData->transaction(DataTable::T_CLR);

            foreach ($this->mData as $key => $value) {
                if ( ! $sort($key, $value) ) {
                    continue;
                }

                $new->mData->transaction(DataTable::T_SET, $key, $value);
            }
        }

        return $new;
    }

    /**
     * @internal
     * @php
     */
    #[Override("im\util\Collection")]
    public function getIterator(): Traversable {
        return $this->mData->transaction(DataTable::T_ITR);
    }

    /**
     * @internal
     * @php
     */
    public function __clone(): void {
        $this->mData = clone $this->mData;
    }

    /**
     * @internal
     * @php
     */
    public function __debugInfo() {
        return $this->toArray();
    }
}
