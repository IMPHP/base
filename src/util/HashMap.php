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

use Exception;
use Traversable;

/**
 * An modifiable map implementation using hashed keys
 */
class HashMap extends BaseCollection implements MapArray, MutableObjectMappedArray {

    /** @internal */
    protected string $hashAlgo;

    /** @ignore */
    protected array $dataset = [];

    /** @ignore */
    protected array $plainkeys = [];

    /** @ignore */
    protected int $length = 0;

    /**
     * @param $map
     *      A backed map instance
     */
    public function __construct(iterable $map = null) {
        if (in_array("xxh128", hash_algos())) {
            $this->hashAlgo = "xxh128"; // 2.5 times faster than md5

        } else {
            $this->hashAlgo = "md5";
        }

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
        while (($key = $data["keys"]) !== null && ($value = array_pop($data["values"])) !== null) {
            $this->set($key, $value);
        }
    }

    /**
     * @php
     */
    #[Override("im\util\Collection")]
    public function __serialize(): array {
        return [
            "keys" => array_values($this->plainkeys),
            "values" => array_values($this->dataset)
        ];
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\Collection")]
    public function clear(): void {
        $this->dataset = [];
        $this->plainkeys = [];
        $this->length = 0;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\Collection")]
    public function toArray(): array {
        throw new Exception("HashMap cannot be converted to PHP Arrays");
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
    #[Override("im\utils\Collection")]
    public function equals(object $other): bool {
        if (!($other instanceOf ImmutableObjectMappedArray)) {
            return false;
        }

        return $this->getKeys()->equals($other->getKeys())
                && $this->getValues()->equals($other->getValues());
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\Collection")]
    public function traverse(callable $func): bool {
        foreach ($this->dataset as $hashkey => $value) {
            $result = $func($this->plainkeys[$hashkey], $value);

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
    function copy(callable $sort = null): static {
        $new = clone $this;

        if ($sort != null) {
            $new->clear();

            foreach ($this->dataset as $hashkey => $value) {
                $key = $this->plainkeys[$hashkey];

                if ( ! $sort($key, $value) ) {
                    continue;
                }

                $new->dataset[$hashkey] = $value;
                $new->plainkeys[$hashkey] = $key;
                $new->length++;
            }
        }

        return $new;
    }

    /**
     * @internal
     */
    #[Override("im\utils\Collection")]
    public function getIterator(): Traversable {
        foreach ($this->dataset as $hashkey => $value) {
            yield ($this->plainkeys[$hashkey]) => $value;
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\MutableMappedArray")]
    public function addIterable(iterable $map): void {
        foreach ($map as $key => $value) {
            $hashkey = $this->resolveKey($key);

            if (!isset($this->dataset[$hashkey])) {
                $this->length++;
            }

            $this->dataset[$hashkey] = $value;
            $this->plainkeys[$hashkey] = $key;
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\MutableMappedArray")]
    public function remove(mixed $value): int {
        $i = 0;

        while (($hashkey = array_search($value, $this->dataset, true)) !== false) {
            unset($this->dataset[$hashkey]);
            unset($this->plainkeys[$hashkey]);

            $i++;
        }

        $this->length -= $i;

        return $i;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ObjectMappedArray")]
    public function set(mixed $key, mixed $value): mixed {
        $hashkey = $this->resolveKey($key);

        if (isset($this->dataset[$hashkey])) {
            $cur = $this->dataset[$hashkey];

        } else {
            $this->length++;
            $cur = null;
        }

        $this->dataset[$hashkey] = $value;
        $this->plainkeys[$hashkey] = $key;

        return $cur;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ObjectMappedArray")]
    public function unset(mixed $key): mixed {
        $hashkey = $this->resolveKey($key);

        if (isset($this->dataset[$hashkey])) {
            $cur = $this->dataset[$hashkey];
            $this->length--;

            unset($this->dataset[$hashkey]);
            unset($this->plainkeys[$hashkey]);

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
        $new->clear();

        foreach ($this->dataset as $hashkey => $value) {
            $key = $this->plainkeys[$hashkey];

            if ( ! $sort($key, $value) ) {
                continue;
            }

            $new->dataset[$hashkey] = $value;
            $new->plainkeys[$hashkey] = $key;
            $new->length++;
        }

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
        $list->addIterable(array_values($this->plainkeys));

        return $list;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableObjectMappedArray")]
    public function get(mixed $key, mixed $defVal = null): mixed {
        return $this->dataset[$this->resolveKey($key)] ?? $defVal;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableObjectMappedArray")]
    public function isset(mixed $key): bool {
        return isset($this->dataset[$this->resolveKey($key)]);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableObjectMappedArray")]
    public function find(mixed $value): mixed {
        return ($hashkey = array_search($value, $this->dataset, true)) !== false
                            ? $this->plainkeys[$hashkey] : null;
    }

    /**
     * @internal
     */
    protected function resolveKey(mixed $key): string {
        if (is_object($key)) {
            return spl_object_hash($key);

        } else {
            return hash($this->hashAlgo, strval($key), true);
        }
    }
}
