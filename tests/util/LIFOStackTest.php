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
namespace im\test\util;

use PHPUnit\Framework\TestCase;
use im\util\LIFOStack;

/**
 *
 */
final class LIFOStackTest extends TestCase {

    /**
     *
     */
    public function test_expansion(): void {
        $stack = new LIFOStack();

        $this->assertEquals(null, $stack->peak());

        $i = 0;
        while ($i++ < 100) {
            $stack->push("Stack $i");
        }

        $i = 100;
        while (97 < $i) {
            $this->assertEquals("Stack ".($i--), $stack->pop());
        }

        $stack->push("Stack $i");
        $this->assertEquals("Stack $i", $stack->peak());
    }

    /**
     *
     */
    public function test_join(): void {
        $stack = new LIFOStack();
        $stack->push("Col1");
        $stack->push("Col2");
        $stack->push("Col3");

        $this->assertEquals(
            ["Col1", "Col2", "Col3"],
            $stack->toArray()
        );

        $stack2 = $stack->copy(function(mixed $key, mixed $val){
            return $val != "Col2";
        });

        $this->assertEquals(
            ["Col1", "Col3"],
            $stack2->toArray()
        );
    }
}
