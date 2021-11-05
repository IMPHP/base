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
 * An unmodifiable map implementation
 */
class Map extends BaseCollection implements MapArray, MutableStringMappedArray {

    /**
     * @param $map
     *      A backed map instance
     */
    public function __construct(iterable $map = null) {
        parent::__construct();

        if ($map != null) {
            $this->addIterable($map);
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\MappedArray")]
    public function addIterable(iterable $map): void {
        foreach ($map as $key => $value) {
            if (is_string($key)) {
                $this->dataset["table"][$key] = $value;
                $this->dataset["length"]++;
            }
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\MappedArray")]
    public function remove(mixed $value): int {
        $i = 0;

        while (($key = array_search($value, $this->dataset["table"], true)) !== false) {
            unset($this->dataset["table"][$key]);
            $i++;
        }

        $this->dataset["length"] -= $i;

        return $i;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\StringMappedArray")]
    public function set(string $key, mixed $value): mixed {
        if (isset($this->dataset["table"][$key])) {
            $cur = $this->dataset["table"][$key];

        } else {
            $this->dataset["length"]++;
            $cur = null;
        }

        $this->dataset["table"][$key] = $value;

        return $cur;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\StringMappedArray")]
    public function unset(string $key): mixed {
        if (isset($this->dataset["table"][$key])) {
            $cur = $this->dataset["table"][$key];
            $this->dataset["length"]--;

            unset($this->dataset["table"][$key]);

            return $cur;
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableMappedArray")]
    public function contains(mixed $value): bool {
        return in_array($value, $this->dataset["table"], true);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableMappedArray")]
    public function getValues(): ListArray {
        $list = new Vector();
        $list->addIterable(array_values($this->dataset["table"]));

        return $list;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableMappedArray")]
    public function getKeys(): ListArray {
        $list = new Vector();
        $list->addIterable(array_keys($this->dataset["table"]));

        return $list;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableStringMappedArray")]
    public function get(string $key, mixed $defVal = null): mixed {
        return $this->dataset["table"][$key] ?? $defVal;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableStringMappedArray")]
    public function isset(string $key): bool {
        return isset($this->dataset["table"][$key]);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableStringMappedArray")]
    public function find(mixed $value): ?string {
        return ($key = array_search($value, $this->dataset["table"], true)) !== false ? $key : null;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\Collection")]
    public function equals(object $other): bool {
        if (!($other instanceOf ImmutableStringMappedArray)) {
            return false;
        }

        return $this->toArray() == $other->toArray();
    }
}
