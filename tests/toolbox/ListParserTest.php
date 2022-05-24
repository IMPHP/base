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
namespace im\test\toolbox;

use PHPUnit\Framework\TestCase;
use im\toolbox\ListParser;

/**
 *
 */
final class ListParserTest extends TestCase {

    /**
     *
     */
    public function test_scanLine(): void {
        $parser = new class() {
            use ListParser { scanLine as public; }
        };

        $line = $parser->scanLine("   Col_1 Col_2  \tCol\\ 3", "col1", "col2", "col3");
        $this->assertEquals(
            ["col1" => "Col_1", "col2" => "Col_2", "col3" => "Col 3"],
            $line
        );

        $line = $parser->scanLine("#   col1 col2  \tcol\\ 3", "col1", "col2", "col3");
        $this->assertNull(
            $line
        );

        $line = $parser->scanLine("", "col1", "col2", "col3");
        $this->assertNull(
            $line
        );
    }
}
