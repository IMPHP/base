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

use IteratorAggregate;

/**
 * Defines a base collection interface.
 *
 * Arrays in PHP is a great internal tool because of their flexibility.
 * However they are not that great as parameters and return types for
 * this exact reason. It's dificult to keep track of their actual
 * content and their structure. Strict collection classes makes this
 * much easier when you can distinguish between a list or a map for example.
 */
interface Collection extends IteratorAggregate {

    /**
     * Clear the collection. This will remove all data from the
     * collections internal dataset and reset it back to the state
     * when the collection instance was first created.
     */
    function clear(): void;

    /**
     * Get the current length of the collection.
     *
     * @return
     *      Returns an `integer` containing the current number of
     *      values within the collection.
     */
    function length(): int;

    /**
     * Builds a PHP array containing all of the current values within
     * the collection. If the collection is empty, and empty array is returned.
     *
     * @return
     *      Returns an `array` with all the values from the collection.
     */
    function toArray(): array;

    /**
     * Clone this instance and return it.
     *
     * @param $sort
     *      An optional `callable(mixed $key, mixed $value)`.
     *
     *      This will be called on each value when copying a collection.
     *      If the `callable` returns `false`, the value will not be copied
     *      to the new collection and if the `callable` returns `true` then it will.
     *
     * @return
     *      Returns a cloned version of this instance.
     */
    function copy(callable $sort = null): static;

    /**
     * Compare an object against this instance.
     * This will match both the type and the content.
     *
     * @example
     *
     *      ```php
     *      $ins1 = new HashSet( ["Val1", "Val2"] );
     *      $ins2 = new Vector( ["Val1", "Val2"] );
     *      $ins3 = new Set( ["Val1", "Val2", "Val3"] );
     *
     *      $ins1->equals($ins2); // Returns true
     *      $ins2->equals($ins1); // Returns false
     *      $ins3->equals($ins1); // Returns false
     *      ```
     *
     *      The first returns `true` because a HashSet will compare it to `ListArray`
     *      which both instances are a part of. The second will return `false`
     *      because a Vector will compare it to `IndexList` which only Vector is a part of.
     *      The third will return `false` because the two have different values.
     *
     * @param $other
     *      An object to compare against this collection instance.
     *
     * @return
     *      Returns `true` if both are equal type and has the same content
     *      or `false` if type or content does not match.
     */
    function equals(object $other): bool;
}
