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

    /**
     * @param $map
     *      A backed map instance
     */
    public function __construct(iterable $map = null) {
        parent::__construct();

        if (in_array("xxh128", hash_algos())) {
            $this->hashAlgo = "xxh128"; // 2.5 times faster than md5

        } else {
            $this->hashAlgo = "md5";
        }

        $this->dataset["keys"] = [];

        if ($map != null) {
            $this->addIterable($map);
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\Collection")]
    public function clear(): void {
        parent::clear();
        $this->dataset["keys"] = [];
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
        foreach ($this->dataset["table"] as $hashkey => $value) {
            $result = $func($this->dataset["keys"][$hashkey], $value);

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

            foreach ($this->dataset["table"] as $hashkey => $value) {
                $key = $this->dataset["keys"][$hashkey];

                if ( ! $sort($key, $value) ) {
                    continue;
                }

                $new->dataset["table"][$hashkey] = $value;
                $new->dataset["keys"][$hashkey] = $key;
                $new->dataset["length"]++;
            }
        }

        return $new;
    }

    /**
     * @internal
     */
    #[Override("im\utils\Collection")]
    public function getIterator(): Traversable {
        foreach ($this->dataset["table"] as $hashkey => $value) {
            yield $this->dataset["keys"][$hashkey] => $value;
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\MappedArray")]
    public function addIterable(iterable $map): void {
        foreach ($map as $key => $value) {
            $hashkey = $this->resolveKey($key);

            if (!isset($this->dataset["table"][$hashkey])) {
                $this->dataset["length"]++;
            }

            $this->dataset["table"][$hashkey] = $value;
            $this->dataset["keys"][$hashkey] = $key;
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\MappedArray")]
    public function remove(mixed $value): int {
        $i = 0;

        while (($hashkey = array_search($value, $this->dataset["table"], true)) !== false) {
            unset($this->dataset["table"][$hashkey]);
            unset($this->dataset["keys"][$hashkey]);

            $i++;
        }

        $this->dataset["length"] -= $i;

        return $i;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ObjectMappedArray")]
    public function set(mixed $key, mixed $value): mixed {
        $hashkey = $this->resolveKey($key);

        if (isset($this->dataset["table"][$hashkey])) {
            $cur = $this->dataset["table"][$hashkey];

        } else {
            $this->dataset["length"]++;
            $cur = null;
        }

        $this->dataset["table"][$hashkey] = $value;
        $this->dataset["keys"][$hashkey] = $key;

        return $cur;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ObjectMappedArray")]
    public function unset(mixed $key): mixed {
        $hashkey = $this->resolveKey($key);

        if (isset($this->dataset["table"][$hashkey])) {
            $cur = $this->dataset["table"][$hashkey];
            $this->dataset["length"]--;

            unset($this->dataset["table"][$hashkey]);
            unset($this->dataset["keys"][$hashkey]);

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
        $list->addIterable(array_values($this->dataset["keys"]));

        return $list;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableObjectMappedArray")]
    public function get(mixed $key, mixed $defVal = null): mixed {
        return $this->dataset["table"][$this->resolveKey($key)] ?? $defVal;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableObjectMappedArray")]
    public function isset(mixed $key): bool {
        return isset($this->dataset["table"][$this->resolveKey($key)]);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ImmutableObjectMappedArray")]
    public function find(mixed $value): mixed {
        return ($hashkey = array_search($value, $this->dataset["table"], true)) !== false
                            ? $this->dataset["keys"][$hashkey] : null;
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
