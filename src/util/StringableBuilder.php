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

use Stringable;

/**
 * Defines a simple string builder.
 */
interface StringableBuilder extends Stringable {

    /**
     * Append strings to the end of the current string.
     *
     * @param $texts
     *      Strings to append.
     */
    function append(string|Stringable ...$texts): void;

    /**
     * Prepend strings to the beginning of the current string.
     *
     * @param $texts
     *      Strings to prepend.
     */
    function prepend(string|Stringable ...$texts): void;

    /**
     * Clear this StringBuilder
     */
    function clear(): void;

    /**
     * Get the current length of this StringBuilder
     */
    function length(): int;

    /**
     * Return a PHP `string` of this StringBuilder
     */
    function toString(): string;
}
