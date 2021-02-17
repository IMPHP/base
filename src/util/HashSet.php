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

use im\util\res\DataTable;
use im\util\res\HashTable;
use Traversable;

/**
 * A much faster `Set` to be used when you have a lot of data.
 *
 * So I made some speed tests on my workstation, to compare this
 * HashSet to it's parent. I created some loops that simply added values to
 * each type of Set. _(These numbers will differ depending on the setup they are running in)_
 *
 *  | Iterations | Set       | HashSet |
 *  | ---------: | --------: | ------: |
 *  |     100    |     0 ms  |   0 ms  |
 *  |    1000    |     2 ms  |   1 ms  |
 *  |   10000    |   207 ms  |   5 ms  |
 *  |  100000    | 20991 ms  |  54 ms  |
 *  | 1000000    | + 36 min  | 650 ms  |
 *
 * If you are around 100 values, it does not really make a difference which one you use.
 * This makes sense. Yes there are some overheat with `Set` that is checks for the
 * existence of the value everytime you add one, but there is also some overheat with `HashSet`
 * that it has to create hash values for keyed storage. So around 100 values these two overheats
 * seams to cancel eachother out. But as soon as you are moving to far above 100 values, `HashSet`
 * really starts showing off.
 *
 * @note
 *      This test was done using small and simple strings as value. Objects will be faster for `HashSet`
 *      due to object id's and really long string data will be much slower, because there are more data to run through
 *      when creating the hash id.
 */
class HashSet extends Set {

    /**
     * @internal
     */
    #[Override("im\util\Set")]
    protected function createDataTable(): DataTable {
        return new class() extends HashTable {};
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Set")]
    public function add(mixed $value): void {
        $this->mData->transaction(HashTable::T_SET, $value, true);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Set")]
    public function remove(mixed $value): void {
        $this->mData->transaction(HashTable::T_DEL, $value);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Set")]
    function equals(object $other): bool {
        if (!($other instanceof ListArray)) {
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
     * @inheritDoc
     */
    #[Override("im\util\Set")]
    public function contains(mixed $value): bool {
        return $this->mData->transaction(HashTable::T_CHK, $value);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Set")]
    function toArray(): array {
        $array = [];

        foreach ($this->mData as $key => $value) {
            $array[] = $key;
        }

        return $array;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\Collection")]
    function copy(callable $sort = null): static {
        $new = clone $this;

        if ($sort != null) {
            $new->mData->transaction(HashTable::T_CLR);

            $i = 0;
            foreach ($this->mData as $key => $value) {
                if ( ! $sort($i++, $key) ) {
                    continue;
                }

                $new->mData->transaction(HashTable::T_SET, $key, $value);
            }
        }

        return $new;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\Collection")]
    public function getIterator(): Traversable {
        foreach ($this->mData as $key => $value) {
            yield $key;
        }
    }
}
