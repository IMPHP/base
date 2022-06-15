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
 * An modifiable structured list implementation
 */
interface MutableListArray extends ImmutableListArray {

    /**
     * Clear the list.
     *
     * This will remove all data from the
     * collections internal dataset and reset it back to the state
     * when the collection instance was first created.
     */
    function clear(): void;

    /**
     * Add a value to this list.
     *
     * @param $value
     *      A value that is added to the list.
     */
    function add(mixed $value): void;

    /**
     * Remove a value from the list.
     *
     * @note
     *      This will remove all occurences of the value.
     *
     * @param $value
     *      A value to remove from the list.
     *
     * @return
     *      Returns the number of removed items
     */
    function remove(mixed $value): int;

    /**
     * Add values from an `iterable` object or array.
     *
     * @param $list
     *      An `iterable` object or array to provide
     *      the values that should be added.
     *
     *      Keys will be ignored and values are inserted
     *      in a way that matches the structure of this list.
     */
    function addIterable(iterable $list): void;
}
