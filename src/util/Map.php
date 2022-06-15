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
 * An unmodifiable map implementation
 */
class Map extends BaseCollection implements MapArray, MutableStringMappedArray {

    /** @ignore */
    protected array $dataset = [];

    /** @ignore */
    protected int $length = 0;

    /**
     * @param $map
     *      A backed map instance
     */
    public function __construct(iterable $map = null) {
        if ($map != null) {
            $this->addIterable($map);
        }
    }

    /**
     * @internal
     * @php
     */
    #[Override("im\util\Collection")]
    public function __unserialize(array $data): void {
        $this->addIterable($data);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\Collection")]
    public function clear(): void {
        $this->dataset = [];
        $this->length = 0;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\Collection")]
    public function toArray(): array {
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
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableMappedArray")]
    public function addIterable(iterable $map): void {
        foreach ($map as $key => $value) {
            if (is_string($key)) {
                $this->dataset[$key] = $value;
                $this->length++;
            }
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableMappedArray")]
    public function remove(mixed $value): int {
        $i = 0;

        while (($key = array_search($value, $this->dataset, true)) !== false) {
            unset($this->dataset[$key]);
            $i++;
        }

        $this->length -= $i;

        return $i;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\MutableStringMappedArray")]
    public function set(string $key, mixed $value): mixed {
        if (isset($this->dataset[$key])) {
            $cur = $this->dataset[$key];

        } else {
            $this->length++;
            $cur = null;
        }

        $this->dataset[$key] = $value;

        return $cur;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\MutableStringMappedArray")]
    public function unset(string $key): mixed {
        if (isset($this->dataset[$key])) {
            $cur = $this->dataset[$key];
            $this->length--;

            unset($this->dataset[$key]);

            return $cur;
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\ImmutableMappedArray")]
    public function filter(callable $filter): static {
        $new = clone $this;
        $new->dataset = array_filter($this->dataset, function($v, $k) use ($filter) { return $filter($k, $v); }, ARRAY_FILTER_USE_BOTH);
        $new->length = count($new->dataset);

        return $new;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableMappedArray")]
    public function contains(mixed $value): bool {
        return in_array($value, $this->dataset, true);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableMappedArray")]
    public function getValues(): ListArray {
        $list = new Vector();
        $list->addIterable(array_values($this->dataset));

        return $list;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableMappedArray")]
    public function getKeys(): ListArray {
        $list = new Vector();
        $list->addIterable(array_keys($this->dataset));

        return $list;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableStringMappedArray")]
    public function get(string $key, mixed $defVal = null): mixed {
        return $this->dataset[$key] ?? $defVal;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableStringMappedArray")]
    public function isset(string $key): bool {
        return isset($this->dataset[$key]);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableStringMappedArray")]
    public function find(mixed $value): ?string {
        return ($key = array_search($value, $this->dataset, true)) !== false ? $key : null;
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

    /**
     * @internal
     */
    #[Override("im\utils\Collection")]
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
            $new->clear();

            foreach ($this->dataset as $key => $value) {
                if ( ! $sort($key, $value) ) {
                    continue;
                }

                $new->dataset[$key] = $value;
                $new->length++;
            }
        }

        return $new;
    }
}
