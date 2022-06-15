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

/**
 * An abstract implementation of the `Collection` interface.
 */
abstract class BaseCollection implements Collection {

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
     * @php
     */
    #[Override("im\util\Collection")]
    public function __serialize(): array {
        return $this->toArray();
    }

    /**
     * @php
     */
    #[Override("im\util\Collection")]
    public function __debugInfo(): array {
        return $this->toArray();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    function toArray(): array {
        $ret = [];

        foreach ($this as $key => $value) {
            $ret[$key] = $value;
        }

        return $ret;
    }

    /**
     * Lock the dataset to make it immutable.
     *
     * @deprecated
     *      This method no longer does anything due to that
     *      the underlaying data structure has changed.
     */
    function lock(): void {
        // Nothing
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    public function traverse(callable $func): bool {
        foreach ($this as $key => $value) {
            $result = $func($key, $value);

            if (is_bool($result) && !$result) {
                return false;
            }
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    public function clone(): static {
        return clone $this;
    }
}
