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
 * Defines an unmodifiable structured list
 */
interface ImmutableStructuredList extends ImmutableListArray {

    /**
     * Returns the positional key for a given value
     *
     * The key that is returned is for the first occurance
     * of the specified value.
     *
     * @param $value
     *      Value to seach for.
     *
     * @return
     *      This will return `-1` if no such value was found
     */
    function indexOf(mixed $value): int;

    /**
     * Returns the value for a positional key
     *
     * @param $key
     *      The key to get.
     *
     * @param $defVal
     *      Default value when the key does not exist.
     *
     * @return
     *      This will return `null` or `$defVal` if the
     *      key does not exist. It also returns `$defVal`
     *      if the value is `null`.
     */
    function get(int $key, mixed $defVal = null): mixed;
}
