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
 * An implementation of the `IndexArray` interface.
 */
class Vector extends BaseCollection implements IndexArray {

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

    /* ------------------------------------------------------------
     * Implements methods from IndexArray
     */

    /**
     * @inheritDoc
     */
    #[Override("im\util\IndexArray")]
    public function indexOf(mixed $value): int {
        return $this->mData->transaction(DataTable::T_LOC, null, $value) ?? -1;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\IndexArray")]
    public function get(int $key, mixed $defVal = null): mixed {
        $length = $this->mData->transaction(DataTable::T_LEN);

        if ($key >= 0 && $length <= $key) {
            return null;

        } else if ($key < 0) {
            $key = $length + $key;

            if ($key < 0) {
                return null;
            }
        }

        return $this->mData->transaction(DataTable::T_GET, $key);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\IndexArray")]
    public function set(int $key, mixed $value): void {
        $length = $this->mData->transaction(DataTable::T_LEN);

        if ($key > 0 && $length < $key) {
            throw new Exception("Array position '$key' is out of range");

        } else if ($key < 0) {
            $key = $length + $key;

            if ($key < -1) {
                throw new Exception("Array position '$key' is out of range");

            } else if ($key == -1) {
                $key = 0;
            }
        }

        $this->mData->transaction(DataTable::T_SET, $key, $value);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\IndexArray")]
    public function unset(int $key): mixed {
        $length = $this->mData->transaction(DataTable::T_LEN);

        if ($key >= 0 && $length <= $key) {
            return null;

        } else if ($key < 0) {
            $key = $length + $key;

            if ($key < 0) {
                return null;
            }
        }

        $value = $this->mData->transaction(DataTable::T_GET, $key);

        for ($i=$key, $x=$i+1; $x < $length; $i++, $x++) {
            $this->mData->transaction(
                DataTable::T_SET,
                $i,
                $this->mData->transaction(DataTable::T_GET, $x)
            );
        }

        $this->mData->transaction(DataTable::T_DEL, $length - 1);

        return $value;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\IndexArray")]
    public function insert(int $key, mixed $value): void {
        $length = $this->mData->transaction(DataTable::T_LEN);

        if ($key > 0 && $length < $key) {
            throw new Exception("Array position '$key' is out of range");

        } else if ($key < 0) {
            $key = $length + $key;

            if ($key < -1) {
                throw new Exception("Array position '$key' is out of range");

            } else if ($key == -1) {
                $key = 0;
            }
        }

        if ($key < $length) {
            for ($i=$length, $x=$i-1; $i > $key; $i--, $x--) {
                $this->mData->transaction(
                    DataTable::T_SET,
                    $i,
                    $this->mData->transaction(DataTable::T_GET, $x)
                );
            }
        }

        $this->mData->transaction(DataTable::T_SET, $key, $value);
    }


    /* ------------------------------------------------------------
     * Implements methods from ListArray
     */

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
         $this->mData->transaction(
             DataTable::T_SET,
             $this->mData->transaction(DataTable::T_LEN),
             $value
         );
     }

     /**
      * @inheritDoc
      */
     #[Override("im\util\ListArray")]
     public function remove(mixed $value): void {
         while (($pos = $this->mData->transaction(DataTable::T_LOC, null, $value)) !== null) {
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
         if (!($other instanceof IndexArray)) {
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
