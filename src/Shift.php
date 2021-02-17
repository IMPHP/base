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
namespace im;

/**
 * This class contains a few convertion methods
 */
final class Shift {

    /**
     * @ignore
     */
    private function __construct() {}

    /**
     * Convert a value to a string.
     *
     * @param $data
     *      The value to convert.
     */
    public static function toString(mixed $data): ?string {
        return $data == null || (is_string($data) && $data == "null") ? null : strval($data);
    }

    /**
     * Convert a value to a proper number.
     *
     * This method can convert things like a binary string `0b001101` or
     * a hex string `0x5f80` to an integer. It can also convert strings with regular numbers
     * like `1.487` or `2.24e+10`, or booleans to `1` and `0`, empty string or `null` to `0` and so on.
     *
     * @param $data
     *      The value to convert.
     */
    public static function toNumber(mixed $data): int|float {
        if (is_bool($data)) {
            return $data ? 1 : 0;

        } else if (is_int($data) || is_float($data)) {
            return $data;

        } else if (!is_string($data)) {
            $data = strval($data);
        }

        if (empty($data) || $data == "null") {
            return 0;

        } else if (ctype_digit($data) || (isset($data[1]) && $data[0] == '-' && ctype_digit(substr($data, 1)))) {
            if ($data[0] == '0') {
                return octdec($data);
            }

            return intval($data);

        } else if (isset($data[1]) && $data[0] == '0' && $data[1] == 'b' && preg_match("/^0b(?:0|1)+$/i", $data)) {
            return bindec($data);

        } else if (isset($data[1]) && $data[0] == '0' && $data[1] == 'x' && preg_match("/^0x[0-9a-f]+$/i", $data)) {
            return hexdec($data);

        } else if (preg_match("/^([0-9]+)|([0-9]*[\.][0-9]+)|([0-9]+[\.][0-9]*)|([+-]?[0-9]*[eE][+-]?[0-9]+)$/", $data)) {
            return floatval($data);
        }

        return 0;
    }

    /**
     * Convert a value to a proper integer.
     *
     * This method will run the value through `toNumber()` and
     * then cast it to an integer.
     *
     * @param $data
     *      The value to convert.
     */
    public static function toInteger(mixed $data): int {
        return (int) static::toNumber($data);
    }

    /**
     * Convert a value to a proper integer.
     *
     * This method will run the value through `toNumber()` and
     * then cast it to a float.
     *
     * @param $data
     *      The value to convert.
     */
    public static function toFloat(mixed $data): float {
        return (float) static::toNumber($data);
    }

    /**
     * Convert a value to a proper boolean.
     *
     * This can convert numbers to boolean or
     * strings like `1`, `true`, `on`, `yes` and so on.
     *
     * This can be particular useful when dealing with php.ini configurations,
     * since it does not have much standards in this regard.
     *
     * @param $data
     *      The value to convert.
     */
    public static function toBoolean(mixed $data): bool {
        if (is_bool($data)) {
            return $data;

        } else if (!is_string($data)) {
            $data = strval($data);
        }

        if (in_array(strtolower($data), ["1", "true", "on", "yes", "y"])) {
            return true;
        }

        return false;
    }
}
