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
use im\util\FIFOStack;

/**
 *
 */
final class FIFOStackTest extends TestCase {

    /**
     * Trigger `expandDataset` [9,10,1,2,3,4,5,6,7,8] => [,,1,2,3,4,5,6,7,8,9,10,,,,,,,,]
     */
    public function test_expansionMid(): void {
        $stack = new FIFOStack();

        $i = 0;
        while ($i++ < 100) {
            $stack->push("Stack $i");
        }

        $i = 0;
        while ($i++ < 10) {
            $this->assertEquals("Stack $i", $stack->pop());
        }

        $i = 100;
        while ($i++ < 125) {
            $stack->push("Stack $i");
        }

        $i = 10;
        while ($i++ < 20) {
            $this->assertEquals("Stack $i", $stack->pop());
        }

        $this->assertEquals("Stack $i", $stack->peak());

        foreach ($stack as $value) {
            $this->assertEquals("Stack $i", $value); break;
        }
    }

    /**
     * Trigger `expandDataset` [5,6,7,8,9,10,1,2,3,4] => [5,6,7,8,9,10,,,,,,,,1,2,3,4]
     */
    public function test_expansionHigh(): void {
        $stack = new FIFOStack();

        $i = 0;
        while ($i++ < 100) {
            $stack->push("Stack $i");
        }

        $i = 0;
        while ($i++ < 60) {
            $this->assertEquals("Stack $i", $stack->pop());
        }

        $i = 100;
        while ($i++ < 200) {
            $stack->push("Stack $i");
        }

        $i = 60;
        while ($i++ < 70) {
            $this->assertEquals("Stack $i", $stack->pop());
        }

        $this->assertEquals("Stack $i", $stack->peak());

        foreach ($stack as $value) {
            $this->assertEquals("Stack $i", $value); break;
        }
    }

    /**
     *
     */
    public function test_join(): void {
        $stack = new FIFOStack();
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
