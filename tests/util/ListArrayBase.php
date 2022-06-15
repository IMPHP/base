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
use im\util\Collection;
use im\util\ImmutableListArray;
use im\util\MutableListArray;
use im\util\ListArray;

/**
 *
 */
abstract class ListArrayBase extends TestCase {

    /**
     *
     */
    abstract function initArray(): MutableListArray;

    /**
     *
     */
    public function test_AddRemove(): void {
        $list = $this->initArray();
        $list->add("Value 1");
        $list->addIterable((function(){
            yield "Value 2";
        })());

        $i = 1;
        foreach ($list as $value) {
            $this->assertEquals(
                "Value " . $i++,
                $value
            );
        }

        $this->assertTrue(
            $list->contains("Value 1")
        );

        $list->remove("Value 1");
        $this->assertFalse(
            $list->contains("Value 1")
        );

        $this->assertEquals(
            1,
            $list->length()
        );

        $list->clear();
        $this->assertEquals(
            0,
            $list->length()
        );
    }

    /**
     *
     */
    public function test_join(): void {
        $list = $this->initArray();
        $list->add("Val1");
        $list->add("Val2");
        $list->add("Val3");

        $this->assertEquals(
            "Val1|Val2|Val3",
            $list->join("|")
        );

        $this->assertEquals(
            ["Val1", "Val2", "Val3"],
            $list->toArray()
        );

        $list2 = $list->copy(function(mixed $key, mixed $value) {
            return $value != "Val2";
        });

        $this->assertEquals(
            "Val1|Val3",
            $list2->join("|")
        );

        $list2->add("Val4");
        
        $list3 = $list2->filter(function(mixed $value) {
            return $value != "Val3";
        });

        $this->assertEquals(
            "Val1|Val4",
            $list3->join("|")
        );
    }

    /**
     *
     */
    public function test_instance($list = null): void {
        if ($list == null) {
            $list = $this->initArray();
        }

        $this->assertInstanceOf(Collection::class, $list);
        $this->assertInstanceOf(ImmutableListArray::class, $list);
        $this->assertInstanceOf(MutableListArray::class, $list);

        /*
         * Deprecated:
         *      For compatibility only
         */
        $this->assertInstanceOf(ListArray::class, $list);
    }
}
