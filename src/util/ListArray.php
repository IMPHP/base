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
 * Defines an interface for a list array.
 *
 * A list array is a very basic list that allows you to add content and later iterate through it.
 * It does not define any specific structure for the contained data and as such it's not
 * possible to access individual elements.
 */
interface ListArray extends Collection {

    /**
     * Join all the values in the list into one string.
     *
     * @param $delimiter
     *      Optional string or character that will be added in between
     *      each value in the string.
     *
     * @example
     *
     *      ```php
     *      $ins1 = new HashSet( ["Val1", "Val2"] );
     *      echo $ins1->join(':');
     *      ```
     *
     *      ```
     *      Output: Val1:Val2
     *      ```
     *
     * @return
     *      Returns the joined string.
     */
    function join(string $delimiter = null): string;

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
     */
    function remove(mixed $value): void;

    /**
     * Checks to see if a value exists in this list.
     *
     * @param $value
     *      A value to look for.
     *
     * @return
     *      Returns `true` if an occurences of the value
     *      was found or `false` otherwise.
     */
    function contains(mixed $value): bool;
}
