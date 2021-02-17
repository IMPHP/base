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

    /** @internal */
    protected string $mOutput = "";

    /**
     * @inheritDoc
     */
    #[Override("im\util\StringableBuilder")]
    public function append(string|Stringable ...$texts): void {
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
    public function prepend(string|Stringable ...$texts): void {
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
    public function beginsWith(string|Stringable $text, bool $ci = false): bool {
        $cmp = match ($ci) {
            true => stripos($this->mOutput, strval($text)),
            false => strpos($this->mOutput, strval($text))
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
    public function endsWith(string|Stringable $text, bool $ci = false): bool {
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
    public function contains(string|Stringable $text, bool $ci = false): bool {
        $cmp = match ($ci) {
            true => stripos($this->mOutput, strval($text)),
            false => strpos($this->mOutput, strval($text))
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
    public function equal(string|Stringable $text, bool $ci = false): bool {
        $cmp = match ($ci) {
            true => strcasecmp($this->mOutput, strval($text)),
            false => strcmp($this->mOutput, strval($text))
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
     * @internal
     * @php
     */
    public function __toString(): string {
        return $this->mOutput;
    }
}
