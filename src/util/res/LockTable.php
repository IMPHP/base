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

namespace im\util\res;

use Exception;

/**
 * Extension to `DataTable` that enables immutability.
 *
 * This DataTable extenstion enables immutability by adding a lock feature.
 * By invoking the transaction code `T_LCK`, the dataset will be locked from
 * performing any type of changes to the dataset. You can still lookup values and such,
 * but any attempts at making a change like clearing the dataset, adding or removing a value
 * will throw an exception.
 *
 * @note
 *      If a `LockTable` is cloned, the cloned version will have the dataset unlocked.
 */
abstract class LockTable extends DataTable {

    /**
     * Lock the dataset to make it immutable.
     *
     * @note
     *      Cloned versions of this instance will have their dataset unlocked.
     *
     * @example
     *      ```php
     *      $table->transaction(DataTable::T_LCK, $key);
     *
     *      // Throws exception
     *      $table->transaction(DataTable::T_SET, $key, $value);
     *      ```
     *
     * @var int = 0b00001000
     */
    const /*int*/ T_LCK = 0b00001000;

    /** @internal */
    protected bool $mLocked = false;

    /**
     * @inheritDoc
     */
    #[Override("im\util\res\DataTable")]
    public function transaction(int $code, mixed $key = null, mixed $value = null): mixed {
        if ($code == LockTable::T_LCK) {
            $this->mLocked = true;

            return true;

        } else if ($this->mLocked && $code & 0b1) {
            throw new Exception("Cannot make changes to the immutable dataset");
        }

        return parent::transaction($code, $key, $value);
    }

    /**
     * @internal
     * @php
     */
    #[Override("im\util\res\DataTable")]
    public function __clone(): void {
        parent::__clone();

        // Unlock cloned table
        $this->mLocked = false;
    }
}
