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
 * Defines a modifiable structured list
 */
interface MutableStructuredList extends MutableListArray, ImmutableStructuredList {

    /**
     * Set the value on a positional key
     *
     * Unlike `add()`, this will set the value for a specified key,
     * rather than just appending the value to the end.
     *
     * @note
     *      Note that the key must be either an existing position or represent the end of the list.
     *      You cannot insert data into position `10`, if the list has a length of `7`.
     *
     * @param $key
     *      The key to set/change
     *
     * @param $value
     *      The value to add.
     *
     * @return
     *      The current value
     */
    function set(int $key, mixed $value): mixed;

    /**
     * Remove the element at a positional key
     *
     * @param $key
     *      The key to remove.
     *
     * @return
     *      The current value
     */
    function unset(int $key): mixed;

    /**
     * Insert a value into a positional key
     *
     * Unlike `set()` this will not override the existing
     * value. Instead it will move the data in that position and in front of it,
     * and add the value in between.
     *
     * @param $key
     *      The key to insert into.
     *
     * @param $value
     *      The value to insert.
     *
     * @return
     *      Returns `TRUE` on success or `FALSE` if `$key` was out of range
     */
    function insert(int $key, mixed $value): bool;
}
