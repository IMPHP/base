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

use im\io\Stream;
use im\io\StringStream;

/**
 * An implementation of the `StringableBuilder` interface with additional features.
 *
 * @example
 *
 *      ```php
 *      $str = new StringBuilder();
 *      $str->appendFormat(" - %s = [%s]\\n", $var1, $var2);
 *      $str->append($var3, "\\n");
 *      $str->append($var5, "\\n");
 *
 *      echo $str->toString();
 *      ```
 */
class StringBuilder implements StringableBuilder {

    /**
     *
     */
    const MODE_BOTH = 0;

    /**
     *
     */
    const MODE_LEFT = -1;

    /**
     *
     */
    const MODE_RIGHT = 1;

    /** @internal */
    protected string $mOutput = "";

    /**
     * @param $str
     *      Optional string to add.
     */
    public function __construct(string $str = null) {
        if ($str != null) {
            $this->mOutput = strval($str);
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\StringableBuilder")]
    function getStream(): Stream {
        $stream = new StringStream($this->mOutput);
        $stream->attachStream($this->mOutput);

        return $stream;
    }

    /**
     * Split the current string into a list.
     *
     * @param $separator
     *      A seperator used to split the string.
     */
    public function split(string $separator): MutableStructuredList {
        return new Vector( explode($separator, $this->mOutput) );
    }

    /**
     * A combination of `substr` and `strpos`.
     *
     * This method combines `strpos` to be used for `substr`.
     * Both `offset` and `length` can be defined by an `integer` or by a
     * `string` that will extract the position using `strpos`.
     *
     * @example
     *
     *      ```php
     *      // The new string will start from '0' and stop at the first '\n'
     *      $new = $builder->substrpos(0, "\n");
     *      ```
     *
     * @param $offset
     *      The start position.
     *
     * @param $length
     *      Length beginning from offset.
     *
     * @param $ci
     *      Whether to use case-insensitive search (Only applies on non-integer offset or length)
     *
     * @param $mode
     *      Whether to search left-to-right or right-to-left.
     *
     * @return
     *      May return `null` if `strpos` fails
     */
    public function substrpos(int|string $offset, int|string|null $length = null, bool $ci = false, int $mode = StringBuilder::MODE_LEFT): ?static {
        if (!is_int($offset)) {
            $offset = $this->strpos($offset, StringBuilder::MODE_LEFT ? 0 : -1, $ci, $mode);

            if ($offset == -1) {
                return null;
            }
        }

        if (!is_int($length) && $length != null) {
            $length = $this->strpos($length, $offset, $ci, $mode);

            if ($length == -1) {
                return null;
            }

            if ($offset < 0) {
                $length = $length - (strlen($this->mOutput) + $offset);

            } else {
                $length = $length - $offset;
            }
        }

        return $this->substr($offset, $length);
    }

    /**
     * Return a portion of the string by an offset and length.
     *
     * @param $offset
     *      The start position.
     *
     * @param $length
     *      Length beginning from offset.
     */
    public function substr(int $offset, int|null $length = null): static {
        $builder = clone $this;
        $builder->clear();
        $builder->append( substr($this->mOutput, $offset, $length == 0 ? null : $length) );

        return $builder;
    }

    /**
     * Find the position of the first/last occurrence of a substring.
     *
     * @param $substr
     *      Substring to search for.
     *
     * @param $offset
     *      Offset to start the search from.
     *
     * @param $ci
     *      Whether to use case-insensitive search.
     *
     * @param $mode
     *      Whether to search left-to-right _(first occurrence)_ or right-to-left _(last occurrence)_.
     */
    public function strpos(string $substr, int $offset = 0, bool $ci = false, int $mode = StringBuilder::MODE_LEFT): int {
        if ($mode == StringBuilder::MODE_RIGHT) {
            $loc = match ($ci) {
                true => strripos($this->mOutput, $substr, $offset),
                false => strrpos($this->mOutput, $substr, $offset)
            };

        } else {
            $loc = match ($ci) {
                true => stripos($this->mOutput, $substr, $offset),
                false => strpos($this->mOutput, $substr, $offset)
            };
        }

        return $loc === false ? -1 : $loc;
    }

    /**
     * Replace all occurrences in the string.
     *
     * @param $search
     *      One or more substrings that should be repaced.
     *
     * @param $replace
     *      One or more replacement substrings.
     *
     * @param $ci
     *      Whether to use case-insensitive search.
     */
    public function replace(array|string $search, array|string $replace, bool $ci = false): void {
        if ($ci) {
            $this->mOutput = str_ireplace($search, $replace, $this->mOutput);

        } else {
            $this->mOutput = str_replace($search, $replace, $this->mOutput);
        }
    }

    /**
     * Strip whitespaces and/or custom characters from the beginning and/or end of the string.
     *
     * @param $chars
     *      Optional characters to trim off.
     *
     * @param $mode
     *      Trim left, right or both
     */
    public function trim(string $chars = null, int $mode = StringBuilder::MODE_BOTH): void {
        switch ($mode) {
            case StringBuilder::MODE_BOTH: $this->mOutput = $chars != null ? trim($this->mOutput, $chars) : trim($this->mOutput); break;
            case StringBuilder::MODE_LEFT: $this->mOutput = $chars != null ? ltrim($this->mOutput, $chars) : ltrim($this->mOutput); break;
            case StringBuilder::MODE_RIGHT: $this->mOutput = $chars != null ? rtrim($this->mOutput, $chars) : rtrim($this->mOutput);
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\StringableBuilder")]
    public function insert(int $offset, string ...$texts): void {
        $this->mOutput = substr_replace($this->mOutput, implode("", $texts), $offset, 0);
    }

    /**
     * Insert a formated string to a specific position in the current string.
     *
     * `https://www.php.net/manual/en/function.printf.php`
     *
     * @param $offset
     *      The position in the string to insert at.
     *
     * @param $format
     *      A `printf()` formated string.
     *
     * @param $texts
     *      Placeholder values for the formated string.
     */
    public function insertFormat(int $offset, string $format, mixed ...$texts): void {
        $this->mOutput = substr_replace($this->mOutput, sprintf($format, ...$texts), $offset, 0);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\StringableBuilder")]
    public function append(string ...$texts): void {
        $this->mOutput .= implode("", $texts);
    }

    /**
     * Append a formated string to the end of the current string.
     *
     * `https://www.php.net/manual/en/function.printf.php`
     *
     * @param $format
     *      A `printf()` formated string.
     *
     * @param $texts
     *      Placeholder values for the formated string.
     */
    public function appendFormat(string $format, mixed ...$texts): void {
        $this->mOutput .= sprintf($format, ...$texts);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\StringableBuilder")]
    public function prepend(string ...$texts): void {
        $this->mOutput = implode("", $texts) . $this->mOutput;
    }

    /**
     * Prepend a formated string to the beginning of the current string.
     *
     * `https://www.php.net/manual/en/function.printf.php`
     *
     * @param $format
     *      A `printf()` formated string.
     *
     * @param $texts
     *      Placeholder values for the formated string.
     */
    public function prependFormat(string $format, mixed ...$texts): void {
        $this->mOutput = sprintf($format, ...$texts) . $this->mOutput;
    }

    /**
     * Check to see if this string begins with a specified substring.
     *
     * @param $text
     *      The substring to look for.
     *
     * @param $ci
     *      If this is `true` it will enable `Case Insensitive` search.
     */
    public function beginsWith(string $text, bool $ci = false): bool {
        $cmp = match ($ci) {
            true => stripos($this->mOutput, $text),
            false => strpos($this->mOutput, $text)
        };

        return $cmp === 0;
    }

    /**
     * Check to see if this string ends with a specified substring.
     *
     * @param $text
     *      The substring to look for.
     *
     * @param $ci
     *      If this is `true` it will enable `Case Insensitive` search.
     */
    public function endsWith(string $text, bool $ci = false): bool {
        $text = strval($text);
        $cmp = match ($ci) {
            true => strripos($this->mOutput, $text),
            false => strrpos($this->mOutput, $text)
        };

        return ($cmp + strlen($text)) == strlen($this->mOutput);
    }

    /**
     * Check to see if this string contains a specified substring.
     *
     * @param $text
     *      The substring to look for.
     *
     * @param $ci
     *      If this is `true` it will enable `Case Insensitive` search.
     */
    public function contains(string $text, bool $ci = false): bool {
        $cmp = match ($ci) {
            true => stripos($this->mOutput, $text),
            false => strpos($this->mOutput, $text)
        };

        return $cmp !== false;
    }

    /**
     * Check to see if this string is equal to a specified string.
     *
     * @param $text
     *      The string to compare against.
     *
     * @param $ci
     *      If this is `true` it will enable `Case Insensitive` match.
     */
    public function equal(string $text, bool $ci = false): bool {
        $cmp = match ($ci) {
            true => strcasecmp($this->mOutput, $text),
            false => strcmp($this->mOutput, $text)
        };

        return $cmp === 0;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\StringableBuilder")]
    public function clear(): void {
        $this->mOutput = "";
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\StringableBuilder")]
    public function length(): int {
        return strlen($this->mOutput);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\StringableBuilder")]
    public function toString(): string {
        return $this->mOutput;
    }

    /**
     * @php
     */
    public function __toString(): string {
        return $this->mOutput;
    }
}
