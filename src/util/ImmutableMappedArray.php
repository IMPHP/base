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

namespace im\util;

/**
 * Defines an unmodifiable map
 */
interface ImmutableMappedArray extends Collection {

    /**
     * Check if a value exists in this map
     *
     * @param $value
     *      The value to check
     */
    function contains(mixed $value): bool;

    /**
     * Returns a list of all values assigned to this map
     */
    function getValues(): ListArray;

    /**
     * Returns a list of all keys assigned to this map
     */
    function getKeys(): ListArray;

    /**
     * Filters elements of the collection
     *
     * @param $filter
     *      A `callable(mixed $key, mixed $value): bool`.
     *
     *      This will be called on each value in the dataset.
     *      If the `callable` returns `false`, the value will not be copied
     *      to the new collection and if the `callable` returns `true` then it will.
     */
    function filter(callable $filter): static;
}
