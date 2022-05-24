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

use im\util\ImmutableStructuredList;
use im\util\MutableStructuredList;
use im\util\IndexArray;

/**
 *
 */
abstract class StructuredListBase extends ListArrayBase {

    /**
     *
     */
    abstract function initArray(): MutableStructuredList;

    /**
     *
     */
    public function test_SetUnset(): void {
        $list = $this->initArray();
        $list->add("Val1");
        $list->add("Val2");
        $list->add("Val3");

        $list->set(1, "Val4");
        $this->assertEquals(
            "Val1|Val4|Val3",
            $list->join("|")
        );

        $list->insert(1, "Val5");
        $this->assertEquals(
            "Val1|Val5|Val4|Val3",
            $list->join("|")
        );

        $list->unset(1);
        $list->unset(1);
        $this->assertEquals(
            "Val1|Val3",
            $list->join("|")
        );
    }

    /**
     *
     */
    public function test_Indexing(): void {
        $list = $this->initArray();
        $list->add("Val1");
        $list->add("Val2");
        $list->add("Val3");

        $this->assertEquals(
            1,
            $list->indexOf("Val2")
        );

        $this->assertEquals(
            "Val2",
            $list->get(1)
        );

        $this->assertEquals(
            "DefVal",
            $list->get(10, "DefVal")
        );
    }

    /**
     *
     */
    public function test_instance($list = null): void {
        $list = $this->initArray();

        parent::test_instance($list);

        $this->assertInstanceOf(ImmutableStructuredList::class, $list);
        $this->assertInstanceOf(MutableStructuredList::class, $list);

        /*
         * Deprecated:
         *      For compatibility only
         */
        $this->assertInstanceOf(IndexArray::class, $list);
    }
}
