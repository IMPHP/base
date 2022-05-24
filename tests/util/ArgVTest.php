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
use im\util\ArgV;

final class ArgVTest extends TestCase {

    protected ArgV $Argv;

    /**
     *
     */
    public function __construct() {
        parent::__construct();

        $argv = [
            "/path/to/executable",
            "--help",
            "someaction",
            "-ft",
            "-u",
            "arg[]=somevalue1",
            "--arg[]",
            "somevalue2",
            "--",
            "isolated",
            "--with",
            "args",
            "-x"
        ];

        $this->Argv = new ArgV($argv, ["help"]);
    }


    /* ---------------------------------------
     *  ListArray
     */

    /**
     *
     */
    public function test_getScriptName(): void {
        $this->assertEquals(
            "executable",
            $this->Argv->getScriptName()
        );
    }

    /**
     *
     */
    public function test_getScriptPath(): void {
        $this->assertEquals(
            "/path/to",
            $this->Argv->getScriptPath()
        );
    }

    /**
     *
     */
    public function test_getFlags(): void {
        $this->assertEquals(
            ["help", 'f', 't', 'u'],
            $this->Argv->getFlags()->toArray()
        );
    }

    /**
     *
     */
    public function test_hasFlag(): void {
        $this->assertEquals(
            true,
            $this->Argv->hasFlag('t')
        );
    }

    /**
     *
     */
    public function test_hasOption(): void {
        $this->assertEquals(
            true,
            $this->Argv->hasOption("arg")
        );
    }

    /**
     *
     */
    public function test_getOption(): void {
        $this->assertEquals(
            "somevalue1",
            $this->Argv->getOption("arg")
        );
    }

    /**
     *
     */
    public function test_getOptionAsList(): void {
        $this->assertEquals(
            ["somevalue1", "somevalue2"],
            $this->Argv->getOptionAsList("arg")->toArray()
        );
    }

    /**
     *
     */
    public function test_getOperand(): void {
        $this->assertEquals(
            "someaction",
            $this->Argv->getOperand(0)
        );

        $this->assertEquals(
            "-x",
            $this->Argv->getOperand(-1)
        );
    }

    /**
     *
     */
    public function test_toString(): void {
        $this->assertEquals(
            "/path/to/executable --help -f -t -u --arg[] somevalue1 --arg[] somevalue2 -- someaction isolated --with args -x",
            strval($this->Argv)
        );
    }
}
