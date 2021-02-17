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

/**
 * An implementation of the `ListArray` interface.
 *
 * This is a really slow `SetArray` and should properly not be
 * used in a high produktion invironment. It's fine for a local
 * application where a single user accesses it at one time, but
 * anything besides that and testing, you should consider
 * using `im\util\HashSet` instead.
 */
class Set extends BaseCollection implements ListArray {

    /**
     * @param $values
     *      Optional initiation values.
     *      Only the values will be used.
     */
    public function __construct(iterable $values = null) {
        parent::__construct();

        if ($values != null) {
            $this->addIterable($values);
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\ListArray")]
    public function join(string $delimiter = null): string {
        if ($delimiter == null) {
            $delimiter = ",";
        }

        return implode($delimiter, $this->toArray());
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\ListArray")]
    public function addIterable(iterable $list): void {
        foreach ($list as $value) {
            $this->add($value);
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\ListArray")]
    public function add(mixed $value): void {
        if (!$this->contains($value)) {
            $this->mData->transaction(
                DataTable::T_SET,
                $this->mData->transaction(DataTable::T_LEN),
                $value
            );
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\ListArray")]
    public function remove(mixed $value): void {
        $pos = $this->mData->transaction(DataTable::T_LOC, null, $value);

        if ($pos !== null) {
            $length = $this->mData->transaction(DataTable::T_LEN);

            for ($i=$pos, $x=$i+1; $x < $length; $i++, $x++) {
                $this->mData->transaction(
                    DataTable::T_SET,
                    $i,
                    $this->mData->transaction(DataTable::T_GET, $x)
                );
            }

            $this->mData->transaction(DataTable::T_DEL, $length - 1);
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\ListArray")]
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
    #[Override("im\util\ListArray")]
    public function contains(mixed $value): bool {
        return $this->mData->transaction(DataTable::T_LOC, null, $value) !== null;
    }
}
