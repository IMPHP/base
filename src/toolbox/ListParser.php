<?php declare(strict_types=1);
/*
 * This file is part of the LXC Manager Project: https://github.com/LXCTRL
 *
 * Copyright (c) 2022 Daniel Bergløv, License: MIT
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

namespace im\toolbox;

/**
 * A text parser that can parse simple word bound lines
 *
 * This parser can be used to parse simple custom text config files.
 * It does not have a lot of fancy features, which makes it fast and simple.
 *
 *
 * @example
 *      This example uses a simple file list of routes that can be
 *      used with a router.
 *
 *      ```txt
 *      # This is a comment
 *      #
 *      # Route Name   |   Request Method   |   Route Path   |   Controller
 *      # ----------       --------------       ----------       ----------
 *
 *        none             GET|POST             /page/{id:int}   \namespace\MyController
 *      ```
 *
 *      Now we can parse each line of actual route information:
 *
 *      ```php
 *      $parser = new class() {
 *          use ListParser { scanLine as public; }
 *      };
 *
 *      $stream = new FileStream("route.lst", "r");
 *      while (($line = $stream->readLine()) != null) {
 *          if (($line = $parser->scanLine($line, "name", "method", "route", "controller")) != null) {
 *              print_r($line);
 *          }
 *      }
 *      ```
 *      ```sh
 *      Array
 *      (
 *          [name] => none
 *          [method] => GET|POST
 *          [route] => /page/{id:int}
 *          [controller] => \namespace\MyController
 *      )
 *      ```
 */
trait ListParser {

    /**
     * Scan a line and return the result in an array
     *
     * Finds each word (whitespace devision) and adds it to the array.
     * Each new word will be added as `key` from `$keys` argument in order.
     * So if the first key in `$keys` is `name`, then the first word will be added to
     * the array using `name` as key. It will only search for the amount of words that matches
     * the amount of keys, the rest of the line will remain unparsed.
     *
     * @note
     *      If you need a whitespace in a word, you can escape it using `\`.
     *      Whitespaces are the only characters that excepts escaping.
     *      In any other case, the character `\` is just another character.
     *
     * @param $line
     *      The line that should be parsed
     *
     * @param $keys
     *      Keys to scan for
     */
    protected function scanLine(string $line, string ...$keys): ?array {
        $line = trim($line);

        if (empty($line) || $line[0] == "#") {
            return null;
        }

        $values = [];
        $i = 0;

        foreach ($keys as $key) {
            $values[$key] = "";

            for ($i = $i == 0 ? 0 : $i+1, $x=$i-1, $y=$i+1; $line[$i] ?? null !== null; $i++, $x++, $y++) {
                $ordI = ord($line[$i]);
                $ordX = ord($line[$x] ?? 0);
                $ordY = ord($line[$y] ?? 0);

                if ($ordI < 33 && $ordX != 92) {
                    if ($ordY < 33) {
                        continue;

                    } else {
                        break;
                    }
                }

                if ($ordI != 92 || $ordY > 32) {
                    $values[$key] .= $line[$i];
                }
            }
        }

        return $values;
    }
}
