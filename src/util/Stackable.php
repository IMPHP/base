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

use Traversable;
use SplDoublyLinkedList;

/**
 * Defines a basic stackable class.
 *
 * The order of in/out is not defined in this class,
 * and is decided by the class extending this. This class only
 * defines the basic methods for any stackable class and a few
 * pre-build collection methods. Whether an implementation uses
 * FILO, FIFO or something else entirely, is up to each implementation.
 */
abstract class Stackable extends BaseCollection {


    /** @ignore */
    protected SplDoublyLinkedList $dataset;

    /**
     * @param $capacity
     *      Set the initializesd capacity.
     */
    public function __construct() {
        $this->dataset = new SplDoublyLinkedList();
    }

    /**
     * @internal
     * @php
     */
    #[Override("im\util\Collection")]
    public function __clone(): void {
        $this->dataset = clone $this->dataset;
    }

    /**
     * @internal
     * @php
     */
    #[Override("im\util\Collection")]
    public function __unserialize(array $data): void {
        $this->dataset = new SplDoublyLinkedList();

        foreach ($data as $value) {
            $this->dataset->push($value);
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    function clear(): void {
        $this->dataset = new SplDoublyLinkedList();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    function length(): int {
        return $this->dataset->count();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    public function toArray(): array {
        $array = [];

        for ($i=0; $i < $this->dataset->count(); $i++) {
            $array[] = $this->dataset[$i];
        }

        return $array;
    }

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
     * Returns the current value in the stack.
     *
     * The value that is returned from this, is the next value
     * that will be popped of when calling `pop()`.
     *
     * @return
     *      If this stack is empty, then `NULL` is returned.
     */
    abstract function peak(): mixed;

    /**
     * Returns the current value in the stack.
     *
     * The value that is returned from this, is the next value
     * that will be popped of when calling `pop()`.
     *
     * @deprecated
     *      This method has been replaced by `peak()`
     *
     * @return
     *      If this stack is empty, then `NULL` is returned.
     */
    public function get(): mixed {
        return $this->peak();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    function equals(object $other): bool {
        if (!($other instanceof Stackable)) {
            return false;
        }

        return $this->toArray() == $other->toArray();
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
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    public function traverse(callable $func): bool {
        while ($this->length() > 0) {
            $result = $func(null, $this->pop());

            if (is_bool($result) && !$result) {
                return false;
            }
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    public function copy(callable $sort = null): static {
        $new = clone $this;

        if ($sort != null) {
            $new->clear();

            for ($i=0; $i < $this->dataset->count(); $i++) {
                if ( ! $sort(null, $this->dataset[$i]) ) {
                    continue;
                }

                $new->dataset->push($this->dataset[$i]);
            }
        }

        return $new;
    }
}
