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
use im\util\ImmutableMappedArray;
use im\util\MutableMappedArray;
use im\util\MapArray;

/**
 *
 */
abstract class MappedArrayBase extends TestCase {

    /**
     *
     */
    abstract function initArray(): MutableMappedArray;

    /**
     *
     */
    public function test_AddRemove(): void {
        $map = $this->initArray();
        $map->set("key1", "Value 1");
        $map->set("key2", "Value 2");
        $map->addIterable((function(){
            yield "key3" => "Value 3";
        })());

        $this->assertEquals(
            3,
            $map->length()
        );

        $this->assertEquals(
            "Value 2",
            $map->get("key2")
        );

        $i = 1;
        foreach ($map as $key => $value) {
            $this->assertEquals(
                "key{$i} => Value " . $i++,
                "{$key} => {$value}"
            );
        }

        $this->assertTrue(
            $map->contains("Value 1")
        );

        $this->assertTrue(
            $map->isset("key1")
        );

        $this->assertEquals(
            "key1",
            $map->find("Value 1")
        );

        $map->remove("Value 1");
        $this->assertFalse(
            $map->contains("Value 1")
        );

        $map->unset("key2");
        $this->assertFalse(
            $map->isset("key2")
        );

        $this->assertEquals(
            1,
            $map->length()
        );

        $map->clear();
        $this->assertEquals(
            0,
            $map->length()
        );
    }

    /**
     *
     */
    public function test_join(): void {
        $map = $this->initArray();
        $map->set("key1", "Val1");
        $map->set("key2", "Val2");
        $map->set("key3", "Val3");

        $this->assertEquals(
            ["key1" => "Val1", "key2" => "Val2", "key3" => "Val3"],
            $map->toArray()
        );

        $map2 = $map->copy(function(mixed $key, mixed $value) {
            return $key != "key2";
        });

        $this->assertEquals(
            ["key1" => "Val1", "key3" => "Val3"],
            $map2->toArray()
        );

        $map2->set("key4", "Val4");

        $map3 = $map2->filter(function(mixed $key, mixed $value) {
            return $key != "key3";
        });

        $this->assertEquals(
            ["key1" => "Val1", "key4" => "Val4"],
            $map3->toArray()
        );
    }

    /**
     *
     */
    public function test_instance($map = null): void {
        if ($map == null) {
            $map = $this->initArray();
        }

        $this->assertInstanceOf(Collection::class, $map);
        $this->assertInstanceOf(ImmutableMappedArray::class, $map);
        $this->assertInstanceOf(MutableMappedArray::class, $map);

        /*
         * Deprecated:
         *      For compatibility only
         */
        $this->assertInstanceOf(MapArray::class, $map);
    }
}
