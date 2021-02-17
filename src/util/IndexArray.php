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
 * Defines an interface for a indexed array.
 *
 * A indexed array is a list that uses numbered positions to
 * structure it's data. Each value that is added to the list,
 * is placed in a numbered order below existing values.
 * This numbered position can then be used to access that value specifically.
 *
 * Inlike maps, a numbered position in a indexed list is not fixed.
 * If a value is added or removed in front of an existing value,
 * that value along with everything following, will shift either backward or
 * forward by `1`.
 */
interface IndexArray extends ListArray {

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
     */
    function set(int $key, mixed $value): void;

    /**
     * Remove the element at a positional key
     *
     * @param $key
     *      The key to remove.
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
     */
    function insert(int $key, mixed $value): void;
}
