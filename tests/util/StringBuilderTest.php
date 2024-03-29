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
use im\util\StringBuilder;

/**
 *
 */
final class StringBuilderTest extends TestCase {

    /**
     *
     */
    public function test_append(): void {
        $builder = new StringBuilder();
        $builder->append("#");
        $builder->append("Test", "1");
        $this->assertEquals(
            "#Test1",
            strval($builder)
        );

        $builder->prepend("#", "Test", "2:");
        $this->assertEquals(
            "#Test2:#Test1",
            strval($builder)
        );

        $builder->appendFormat(":#%s%d", "Test", 3);
        $this->assertEquals(
            "#Test2:#Test1:#Test3",
            strval($builder)
        );

        $builder->prependFormat("#%s%d:", "Test", 4);
        $this->assertEquals(
            "#Test4:#Test2:#Test1:#Test3",
            strval($builder)
        );
    }

    /**
     *
     */
    public function test_clear(): void {
        $builder = new StringBuilder();
        $builder->append("123456789");
        $this->assertEquals(
            9,
            $builder->length()
        );

        $builder->clear();
        $this->assertEquals(
            0,
            $builder->length()
        );
    }

    /**
     *
     */
    public function test_toString(): void {
        $builder = new StringBuilder();
        $builder->append("123456789");

        $this->assertEquals(
            "123456789",
            strval($builder)
        );

        $this->assertEquals(
            $builder->toString(),
            strval($builder)
        );
    }
}
