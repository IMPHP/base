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
namespace im\test;

use PHPUnit\Framework\TestCase;
use im\Version;

/**
 *
 */
final class VersionTest extends TestCase {

    /**
     *
     */
    public function test_version(): void {
        $this->assertFalse(
            Version::validate("2.1.4", "!~2.1.0")
        );

        $this->assertTrue(
            Version::validate("2.1.4", "!~2.2.0")
        );

        $this->assertTrue(
            Version::validate("2.1.4", ">1.0 <2.1.5")
        );

        $this->assertTrue(
            Version::validate("2.1.4", ">3.0 || ~2.0")
        );

        $this->assertTrue(
            Version::validate("2.1.4", "2.1.4")
        );

        $this->assertFalse(
            Version::validate("2.1.4", "!>=2.1.4")
        );

        $this->assertTrue(
            Version::validate("2.1.4", ">2.1.4-beta")
        );

        $this->assertFalse(
            Version::validate("2.1.4-beta.1", ">2.1.4-beta.2")
        );
    }
}
