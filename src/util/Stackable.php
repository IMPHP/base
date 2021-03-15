<?php declare(strict_types=1);
/*
 * This file is part of the IMPHP Project: https://github.com/IMPHP
 *
 * Copyright (c) 2021 Daniel Bergløv, License: MIT
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

namespace im\util;

use im\util\res\DataTable;
use Traversable;

/**
 * Defines a basic stackable class.
 * The order of in and out is not defined in this class,
 * and is decided by the class extending this. This class only
 * defines the basic methods for any stackable class and a few
 * pre-build collection methods.
 */
abstract class Stackable implements Collection {

    /** @internal */
    protected DataTable $data;

    /**
     * Push a new value into this stackable instance.
     * The order in which the value is placed, depends on
     * the implementation.
     *
     * @param $value
     *      The new value to add.
     */
    abstract function push(mixed $value): void;

    /**
     * Pop a value off of this stackable instance.
     * The order in which values are removed, depends on
     * the implementation.
     *
     * @return
     *      This will return the value that was popped off the stack.
     *      If this stack is empty, then `NULL` is returned.
     */
    abstract function pop(): mixed;

    /**
     *
     */
    public function __construct() {
        $this->data = $this->createDataTable();
    }

    /**
     * @php
     */
    public function __serialize(): array {
        return $this->mData->__serialize();
    }

    /**
     * @php
     */
    public function __unserialize(array $data): void {
        $this->mData = $this->createDataTable();
        $this->mData->__unserialize($data);
    }

    /**
     * @internal
     */
    protected function createDataTable(): DataTable {
        return new class() extends DataTable {};
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    public function toArray(): array {
        $array = [];

        foreach ($this->data as $value) {
            $array[] = $value;
        }

        return $array;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    function equals(object $other): bool {
        if (!($other instanceof Stackable)) {
            return false;
        }

        if ($this->length() == $other->length()) {
            $arr = $this->toArray();
            $otherArr = $other->toArray();

            sort($arr);
            sort($otherArr);

            return $otherArr == $arr;
        }
    }

    /**
     * @php
     */
    #[Override("im\util\Collection")]
    public function getIterator(): Traversable {
        while ($this->length() > 0) {
            yield $this->pop();
        }
    }

    /**
     * @php
     */
    public function __clone(): void {
        $this->data = clone $this->data;
    }

    /**
     * @php
     */
    public function __debugInfo() {
        return $this->toArray();
    }
}
