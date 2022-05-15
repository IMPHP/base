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

namespace im\toolbox;

use RuntimeException;

/**
 * Small trait to access get/set methods via property access.
 *
 * After including this trait to a class,
 * any `getName()` and `get_name()` method will act as a getter
 * for property access via `$this->name`.
 *
 * Likewise any `setName($var)` and `set_name($var)` will act as
 * a setter via `$this->name = $var`.
 */
trait PropertyAccess {

    /**
     * @ignore
     */
    public function __get(/*string*/ $name) /*mixed*/ {
        if (method_exists($this, ($method = "get".ucfirst($name)))
                || method_exists($this, ($method = "get_$name"))) {

            return $this->$method();
        }

        $trace = debug_backtrace();

        throw new RuntimeException(
            'Undefined property via '. get_class($this) .'__get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line']
        );
    }

    /**
     * @ignore
     */
    public function __set(/*string*/ $name, /*mixed*/ $value) /*void*/ {
        if (method_exists($this, ($method = "set".ucfirst($name)))
                || method_exists($this, ($method = "set_$name"))) {

            return $this->$method($value);
        }

        $trace = debug_backtrace();

        throw new RuntimeException(
            'Undefined property via '. get_class($this) .'__set(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line']
        );
    }
}
