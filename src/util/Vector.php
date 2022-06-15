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

namespace im\util;

use Traversable;

/**
 * Defines an unmodifiable unstructured list
 */
class Vector extends BaseCollection implements IndexArray {

    /** @ignore */
    protected array $dataset = [];

    /** @ignore */
    protected int $length = 0;

    /**
     * @ignore
     */
    public function __construct(iterable $list = null) {
        if ($list != null) {
            $this->addIterable($list);
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\ImmutableListArray")]
    public function filter(callable $filter): static {
        $new = clone $this;
        $new->dataset = array_values(array_filter($this->dataset, $filter));
        $new->length = count($new->dataset);

        return $new;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableListArray")]
    public function join(string $delimiter = null): string {
        return implode($delimiter ?? ",", $this->dataset);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableListArray")]
    public function contains(mixed $value): bool {
        return in_array($value, $this->dataset, true);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableStructuredList")]
    public function indexOf(mixed $value): int {
        return ($pos = array_search($value, $this->dataset, true)) !== false ? $pos : -1;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableStructuredList")]
    public function get(int $key, mixed $defVal = null): mixed {
        if ($key < 0) {
            $key = $this->length + $key;

            if ($key < 0) {
                $key = 0;
            }
        }

        return $this->dataset[$key] ?? $defVal;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\MutableListArray")]
    public function add(mixed $value): void {
        $this->dataset[ $this->length++ ] = $value;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\MutableListArray")]
    public function clear(): void {
        $this->dataset = [];
        $this->length = 0;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\MutableListArray")]
    public function remove(mixed $value): int {
        $i = 0;

        while (($pos = array_search($value, $this->dataset, true)) !== false) {
            array_splice($this->dataset, $pos, 1);
            $i++;
        }

        $this->length -= $i;

        return $i;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\MutableListArray")]
    public function addIterable(iterable $list): void {
        foreach ($list as $value) {
            $this->dataset[ $this->length++ ] = $value;
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\MutableStructuredList")]
    public function set(int $key, mixed $value): mixed {
        if ($key < 0) {
            $key = $this->length + $key;

            if ($key < 0) {
                $key = 0;
            }
        }

        if ($key < $this->length) {
            $cur = $this->dataset[$key];
            $this->dataset[$key] = $value;

            return $cur;
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\MutableStructuredList")]
    public function unset(int $key): mixed {
        if ($key < 0) {
            $key = $this->length + $key;

            if ($key < 0) {
                $key = 0;
            }
        }

        if ($key < $this->length) {
            $removed = array_splice($this->dataset, $key, 1);
            $this->length--;

            return $removed[0];
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\MutableStructuredList")]
    public function insert(int $key, mixed $value): bool {
        if ($key < 0) {
            $key = $this->length + $key;

            if ($key < 0) {
                $key = 0;
            }
        }

        if ($key <= $this->length) {
            array_splice($this->dataset, $key, 0, [$value]);
            $this->length++;

            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\MutableStructuredList")]
    public function sort(callable $filter): void {
        usort($this->dataset, $filter);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\Collection")]
    public function equals(object $other): bool {
        if (!($other instanceOf ImmutableListArray)) {
            return false;
        }

        return $this->toArray() == $other->toArray();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    function toArray(): array {
        return $this->dataset;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    function length(): int {
        return $this->length;
    }

    /**
     * @internal
     * @php
     */
    #[Override("im\util\Collection")]
    public function getIterator(): Traversable {
        foreach ($this->dataset as $key => $value) {
            yield $key => $value;
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    function copy(callable $sort = null): static {
        $new = clone $this;

        if ($sort != null) {
            $new->dataset = array_values(array_filter($this->dataset, function($v, $k) use ($sort) { return $sort($k, $v); }, ARRAY_FILTER_USE_BOTH));
            $new->length = count($new->dataset);
        }

        return $new;
    }

    /**
     * @internal
     * @php
     */
    #[Override("im\util\Collection")]
    public function __unserialize(array $data): void {
        $this->dataset = array_values($data);
    }
}
