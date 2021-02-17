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
 * Defines an interface for a mapped array.
 *
 * A mapped array is a list that uses keys to structure it's data.
 * Each value within a map has a key that points to it and can be used
 * to access it.
 */
interface MapArray extends Collection {

    /**
     * Add elements from an iterator
     */
    function addIterable(iterable $list): void;

    /**
     * Return a value from within this bundle
     *
     * @param $key
     *      Key that was used to assign the value
     *
     * @param $defVal
     *      Optional default value that is returned when no mapping could be found
     */
    function get(string $key, mixed $defVal = null): mixed;

    /**
     * Add/Replace a value in this map
     *
     * @param $key
     *      Key that is used to assign the value
     *
     * @param $defVal
     *      The value to assign
     */
    function set(string $key, mixed $value): void;

    /**
     * Remove a value from this map.
     *
     * @param $key
     *      Key that was used to assign the value
     *
     * @return
     *      The value that was removed
     */
    function unset(string $key): mixed;

    /**
     * Check if a key has been assigned to this map
     *
     * @param $key
     *      The key to check
     */
    function isset(string $key): bool;

    /**
     * Remove a value from all assigned keys within this map
     *
     * Searches for a specified value and removes all occurrences
     * that it finds.
     *
     * @param $value
     *      The value to remove
     */
    function remove(mixed $value): void;

    /**
     * Check if a value exists in this map
     *
     * @param $value
     *      The value to check
     */
    function contains(mixed $value): bool;

    /**
     * Find the key matching the first location with a specified value
     */
    function find(mixed $value): mixed;

    /**
     * Returns an indexed list of all values assigned to this bundle
     */
    function getValues(): IndexArray;

    /**
     * Returns an indexed list of all keys assigned to this bundle
     */
    function getKeys(): IndexArray;
}
