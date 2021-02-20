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

use IteratorAggregate;
use Traversable;

/**
 * This is a light absstraction to dealing with a PHP array.
 *
 * The point of this class, is to provide a way to deal with a PHP array,
 * while also allowing modifications in terms of extends or replace.
 * This allows you to add other features to something that is using this class,
 * by for an example, extending this class, without hardly touching whatever is using it.
 *
 * To keep this simple and as light weight as possible, this class
 * is dumb as a nail. It does not do any sort of checking on things like
 * arguments and such, since this is the task of the implementer.
 *
 * Also it's build on a simple transaction scheme. This makes a simple layout
 * and also allows adding more features, without breaking old implementations or implementers.
 *
 * @note
 *      The bits in the transaction code are used as following.
 *      The last 3 bits tells `transaction` what operation is being performed.
 *
 *      0b00[1]
 *      -------
 *      Performs a change in the dataset
 *
 *      0b0[1]0
 *      -------
 *      Performs a possible change in the dataset size (1 = add, 0 = remove).
 *      This is only read if the first bit is set.
 *
 *      0b[1]00
 *      -------
 *      Needs to re-check the dataset length (Rather than just adding or subtracting 1).
 *      This is only read if the first bit is set.
 *
 *      The 4'th bit is reserved, just in case. The remaining bits follows regular decimal scheme, starting at `1`.
 *
 * @example
 *
 *      ```php
 *      $table = new DataTable();
 *      $table->transaction(DataTable::T_SET, $key, $value);
 *
 *      foreach ($table as $key => $value) {
 *          // ...
 *      }
 *      ```
 *
 * @example
 *      Extending this class is easy.
 *
 *      ```php
 *      class MyTable extends DataTable {
 *          public function transaction(int $code, int|string $key = null, mixed $value = null): mixed {
 *              if ($code & 0b1) {
 *                  throw new Exception("It's now allowed to make changes to this dataset");
 *              }
 *
 *              return parent::transaction($code, $key, $value);
 *          }
 *      }
 *      ```
 *
 *      The above class will prevent any changes to the dataset. It's not very useful,
 *      but any class that is build to use `DataTable` can easily work with the modified version
 *      without much trouble.
 */
abstract class DataTable implements IteratorAggregate {

    /**
     * Re-sync dataset length.
     *
     * By default most transactions will trigger an internal
     * length variable to be changed by `1`. This code will
     * force the instance to sync the length of the dataset by
     * counting the actual values being stored.
     *
     * This is mostly useful if you extend this class and perform some operation
     * that may require this, while allowing the original class handle it.
     *
     * @note
     *      This transaction does not provide a return value.
     *
     * @var int = 0b00000101
     */
    const /*int*/ T_CNT = 0b00000101;

    /**
     * Get a value from the dataset.
     *
     * @note
     *      This transaction will return the value being requested or `NULL`
     *      if the defined key does not exist.
     *
     * @example
     *      ```php
     *      $value = $table->transaction(DataTable::T_GET, $key);
     *      ```
     *
     * @var int = 0b00010000
     */
    const /*int*/ T_GET = 0b00010000;

    /**
     * Set a value in the dataset.
     *
     * @note
     *      This transaction does not provide a return value.
     *
     * @example
     *      ```php
     *      $table->transaction(DataTable::T_SET, $key, $value);
     *      ```
     *
     * @var int = 0b00100011
     */
    const /*int*/ T_SET = 0b00100011;

    /**
     * Check to see if a key exists.
     *
     * @note
     *      This transaction will return `TRUE` if the key exists
     *      or `FALSE` otherwise.
     *
     * @example
     *      ```php
     *      if ($table->transaction(DataTable::T_CHK, $key)) {
     *          // ...
     *      }
     *      ```
     *
     * @var int = 0b00110000
     */
    const /*int*/ T_CHK = 0b00110000;

    /**
     * Remove a key from the dataset. This will not produce any errors
     * if the key does not exist.
     *
     * @note
     *      This transaction does not provide a return value.
     *
     * @example
     *      ```php
     *      $table->transaction(DataTable::T_DEL, $key);
     *      ```
     *
     * @var int = 0b01000001
     */
    const /*int*/ T_DEL = 0b01000001;

    /**
     * Clear the whole dataset
     *
     * @note
     *      This transaction does not provide a return value.
     *
     * @example
     *      ```php
     *      $table->transaction(DataTable::T_CLR);
     *      ```
     *
     * @var int = 0b01010101
     */
    const /*int*/ T_CLR = 0b01010101;

    /**
     * Get the current length of the dataset
     *
     * @note
     *      This transaction will return the number of keys/values that is being stored.
     *
     * @example
     *      ```php
     *      if ($table->transaction(DataTable::T_LEN) > 0) {
     *          // ...
     *      }
     *      ```
     *
     * @var int = 0b01100000
     */
    const /*int*/ T_LEN = 0b01100000;

    /**
     * Get an iterator for the dataset.
     *
     * @note
     *      You don't have to invoke this transaction. You can simply iterate the instance
     *      itself. This is mostly to be used when extending this class, to allow changing
     *      the iterator in a consistent maner.
     *
     * @note
     *      This transaction will return an iterator for this dataset.
     *
     * @example
     *      ```php
     *      $itt = $table->transaction(DataTable::T_ITR);
     *
     *      if ($itt as $key => $value) {
     *          // ...
     *      }
     *      ```
     *
     * @var int = 0b01110000
     */
    const /*int*/ T_ITR = 0b01110000;

    /**
     * Get the position/key of a value within the dataset
     *
     * @note
     *      This transaction will return the position/key to the specified value.
     *
     * @var int = 0b10000000
     */
    const T_LOC = 0b10000000;

    /** @internal */
    protected array $mData = [];

    /** @internal */
    protected int $mLength = 0;

    /**
     * Perform a transaction on this dataset.
     * You can use the `DataTable::T_` constants to define the transation.
     *
     * @param $code
     *      A transaction code.
     *
     * @param $key
     *      A dataset key, if the transaction requires it.
     *
     * @param $value
     *      A dataset value, if the transaction requires it.
     *
     * @return
     *      Returned values are defiend by the transaction. Some transactions does not
     *      provide a return value.
     */
    public function transaction(int $code, int|string $key = null, mixed $value = null): mixed {
        $result = null;

        if ($code & 0b1) {
            if ((($code & 0b110) == 2 && !isset($this->mData[$key]))
                    || (($code & 0b110) == 0 && isset($this->mData[$key]))) {

                $this->mLength += $code & 0b10 ? 1 : -1;
            }

            switch ($code) {
                case DataTable::T_SET: $this->mData[$key] = $value; break;
                case DataTable::T_DEL: unset($this->mData[$key]); break;
                case DataTable::T_CLR: $this->mData = [];
            }

            if ($code & 0b100) {
                $this->mLength = count($this->mData);
            }

        } else {
            switch ($code) {
                case DataTable::T_GET: $result = $this->mData[$key] ?? null; break;
                case DataTable::T_CHK: $result = isset($this->mData[$key]); break;
                case DataTable::T_LEN: $result = $this->mLength; break;
                case DataTable::T_LOC:
                                        $result = array_search($value, $this->mData, true);

                                        if ($result === false) {
                                            $result = null;
                                        }

                                        break;

                case DataTable::T_ITR:
                    $result = (function(): Traversable {
                        foreach ($this->mData as $key => $value) {
                            yield $key => $value;
                        }
                    })();
            }
        }

        return $result;
    }

    /**
     * @internal
     * @php
     */
    #[Override("IteratorAggregate")]
    public function getIterator(): Traversable {
        return $this->transaction(DataTable::T_ITR);
    }

    /**
     * @internal
     * @php
     */
    public function __clone(): void {

    }
}
