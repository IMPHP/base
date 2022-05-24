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

use stdClass;
use im\util\MutableMappedArray;
use im\util\HashMap;

/**
 *
 */
final class HashMapTest extends MappedArrayBase {

    /**
     *
     */
    public function initArray(): MutableMappedArray {
        return new HashMap();
    }

    /**
     *
     */
    public function test_join(): void {
        $map = $this->initArray();
        $map->set("key1", "Val1");
        $map->set("key2", "Val2");
        $map->set("key3", "Val3");

        $array = [];
        foreach ($map as $key => $val) {
            $array[$key] = $val;
        }

        $this->assertEquals(
            ["key1" => "Val1", "key2" => "Val2", "key3" => "Val3"],
            $array
        );

        $map2 = $map->copy(function(mixed $key, mixed $value) {
            return $key != "key2";
        });

        $array = [];
        foreach ($map2 as $key => $val) {
            $array[$key] = $val;
        }

        $this->assertEquals(
            ["key1" => "Val1", "key3" => "Val3"],
            $array
        );
    }

    /**
     *
     */
    public function test_objects(): void {
        $key1 = new stdClass();
        $key2 = new stdClass();

        $map = $this->initArray();
        $map->set($key1, "val1");
        $map->set($key2, "val2");

        $this->assertTrue(
            $key1 === $map->find("val1")
        );

        $this->assertFalse(
            $key1 === $map->find("val2")
        );

        $this->assertEquals(
            "val2",
            $map->get($key2)
        );
    }
}
