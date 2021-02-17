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
use Exception;

/**
 * An implementation of the `MapArray` interface.
 */
class Map extends BaseCollection implements MapArray {

    /**
     * @param values
     *      Optional initiation values.
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
     #[Override("im\util\MapArray")]
     public function addIterable(iterable $list): void {
         foreach ($list as $key => $value) {
             if (!is_string($key)) {
                 throw new Exception("Invalid type '".gettype($key)."' cannot be used as key");
             }

             $this->set($key, $value);
         }
     }

    /**
     * @inheritDoc
     */
    #[Override("im\util\MapArray")]
    public function get(string $key, mixed $defVal = null): mixed {
        return $this->mData->transaction(DataTable::T_GET, $key) ?? $defVal;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\MapArray")]
    public function set(string $key, mixed $value): void {
        $this->mData->transaction(DataTable::T_SET, $key, $value);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\MapArray")]
    public function unset(string $key): mixed {
        $value = $this->mData->transaction(DataTable::T_GET, $key);
        $this->mData->transaction(DataTable::T_DEL, $key);

        return $value;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\MapArray")]
    public function isset(string $key): bool {
        return $this->mData->transaction(DataTable::T_CHK, $key);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\MapArray")]
    public function remove(mixed $value): void {
        while (($key = $this->mData->transaction(DataTable::T_LOC, null, $value)) != null) {
            $this->mData->transaction(DataTable::T_DEL, $key);
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\MapArray")]
    public function find(mixed $value): mixed {
        return $this->mData->transaction(DataTable::T_LOC, null, $value);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\MapArray")]
    public function contains(mixed $value): bool {
        return $this->mData->transaction(DataTable::T_LOC, null, $value) != null;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\MapArray")]
    public function getValues(): IndexArray {
        $vals = new Vector();

        foreach ($this->mData as $value) {
            $vals->add($value);
        }

        return $vals;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\MapArray")]
    public function getKeys(): IndexArray {
        $vals = new Vector();

        foreach ($this->mData as $key => $value) {
            $vals->add($key);
        }

        return $vals;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\MapArray")]
    function equals(object $other): bool {
        if (!($other instanceof MapArray)) {
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
}
