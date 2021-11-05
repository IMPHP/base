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
 * An modifiable unstructured list implementation
 */
class HashSet extends BaseCollection implements ListArray {

    /** @internal */
    protected string $hashAlgo;

    /**
     * @ignore
     */
    public function __construct(iterable $list = null) {
        parent::__construct();

        if (in_array("xxh128", hash_algos())) {
            $this->hashAlgo = "xxh128"; // 2.5 times faster than md5

        } else {
            $this->hashAlgo = "md5";
        }

        if ($list != null) {
            $this->addIterable($list);
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\Collection")]
    public function toArray(): array {
        return array_values($this->dataset["table"]);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\Collection")]
    public function traverse(callable $func): bool {
        foreach ($this->dataset["table"] as $value) {
            $result = $func(null, $value);

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

            foreach ($this->dataset["table"] as $key => $value) {
                if ( ! $sort(null, $value) ) {
                    continue;
                }

                $new->dataset["table"][$key] = $value;
            }
        }

        return $new;
    }

    /**
     * @internal
     */
    #[Override("im\utils\Collection")]
    public function getIterator(): Traversable {
        foreach ($this->dataset["table"] as $value) {
            yield $value;
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
        return isset($this->dataset["table"][$this->resolveKey($value)]);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ListArray")]
    public function add(mixed $value): void {
        $hashkey = $this->resolveKey($value);

        if (!isset($this->dataset["table"][$hashkey])) {
            $this->dataset["length"]++;
        }

        $this->dataset["table"][$hashkey] = $value;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ListArray")]
    public function remove(mixed $value): int {
        $hashkey = $this->resolveKey($value);

        if (isset($this->dataset["table"][$hashkey])) {
            unset($this->dataset["table"][$hashkey]);
            $this->dataset["length"]--;

            return 1;
        }

        return 0;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\ListArray")]
    public function addIterable(iterable $list): void {
        foreach ($list as $value) {
            $hashkey = $this->resolveKey($value);

            if (!isset($this->dataset["table"][$hashkey])) {
                $this->dataset["length"]++;
            }

            $this->dataset["table"][$hashkey] = $value;
        }
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
    protected function resolveKey(mixed $key): string {
        if (is_object($key)) {
            return spl_object_hash($key);

        } else {
            return hash($this->hashAlgo, strval($key), true);
        }
    }
}
