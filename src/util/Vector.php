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

/**
 * Defines an unmodifiable unstructured list
 */
class Vector extends BaseCollection implements IndexArray {

    /**
     * @ignore
     */
    public function __construct(iterable $list = null) {
        parent::__construct();

        if ($list != null) {
            $this->addIterable($list);
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableListArray")]
    public function join(string $delimiter = null): string {
        return implode($delimiter ?? ",", $this->dataset["table"]);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableListArray")]
    public function contains(mixed $value): bool {
        return in_array($value, $this->dataset["table"], true);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableStructuredList")]
    public function indexOf(mixed $value): int {
        return ($pos = array_search($value, $this->dataset["table"], true)) !== false ? $pos : -1;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableStructuredList")]
    public function get(int $key, mixed $defVal = null): mixed {
        return $this->dataset["table"][$this->resolveKey($key)] ?? $defVal;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ListArray")]
    public function add(mixed $value): void {
        $this->dataset["table"][ $this->dataset["length"]++ ] = $value;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ListArray")]
    public function remove(mixed $value): int {
        $i = 0;

        while (($pos = array_search($value, $this->dataset["table"], true)) !== false) {
            array_splice($this->dataset["table"], $pos, 1);
            $i++;
        }

        $this->dataset["length"] -= $i;

        return $i;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ListArray")]
    public function addIterable(iterable $list): void {
        foreach ($list as $value) {
            $this->dataset["table"][ $this->dataset["length"]++ ] = $value;
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\StructuredList")]
    public function set(int $key, mixed $value): mixed {
        $key = $this->resolveKey($key);

        if ($key < $this->dataset["length"]) {
            $cur = $this->dataset["table"][$key];
            $this->dataset["table"][$key] = $value;

            return $cur;
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\StructuredList")]
    public function unset(int $key): mixed {
        $key = $this->resolveKey($key);

        if ($key < $this->dataset["length"]) {
            $removed = array_splice($this->dataset["table"], $key, 1);
            $this->dataset["length"]--;

            return $removed[0];
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\StructuredList")]
    public function insert(int $key, mixed $value): bool {
        $key = $this->resolveKey($key);

        if ($key <= $this->dataset["length"]) {
            array_splice($this->dataset["table"], $key, 0, [$value]);
            $this->dataset["length"]++;

            return true;
        }

        return false;
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
     * @internal
     */
    protected function resolveKey(int $key): int {
        if ($key < 0) {
            $key = $this->dataset["length"] + $key;

            if ($key < 0) {
                $key = 0;
            }
        }

        return $key;
    }
}
