<?php declare(strict_types=1);
/*
 * This file is part of the IMPHP Project: https://github.com/IMPHP
 *
 * Copyright (c) 2021 Daniel Bergløv, License: MIT
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
 * This stack-able pushes values to the top while
 * popping them from the bottom.
 *
 * @note
 *      The iterator in this class will pop all returned values.
 *      This means that you can simply iterate through the queue to
 *      pop them in the correct order. It also means that you will loop
 *      forever if you push values during iteration.
 */
class Queue extends Stackable {

    /** @internal */
    protected int $length = 0;

    /** @internal */
    protected int $offset = 0;

    /** @internal */
    protected int $capacity = 100;

    /**
     * @param $capacity
     *      Set the initializesd capacity. 
     */
    public function __construct(int $capacity = 0) {
        parent::__construct();

        $this->capacity = $capacity < 100 ? 100 : $capacity;
    }

    /**
     * @internal
     */
    protected function expandDataset(): void {
        /*
         * [(Y),(Y),X,X,X,X,Y,Y,Y,Y] => [,,X,X,X,X,Y,Y,Y,Y,(Y),(Y),,,,,,,,]
         */
        if ($this->length == $this->capacity && $this->offset < (int) ($this->capacity / 2)) {
            if ($this->offset > 0) {
                $last = (($this->offset + $this->length) % $this->capacity) - 1;
                $newCap = intval($this->capacity * ($this->capacity < 1000 ? 1.5 : 1.25));

                if ($last >= ($newCap - $this->capacity)) {
                    $newCap = $this->capacity + $last + 1;
                }

                for ($i=0,$x=$this->capacity; $i <= $last; $i++,$x++) {
                    $this->data->transaction(
                        DataTable::T_SET,
                        $x,
                        $this->data->transaction(DataTable::T_RPL, $i, null)
                    );
                }

                $this->capacity = $newCap;

            } else {
                $this->capacity = intval($this->capacity * ($this->capacity < 1000 ? 1.5 : 1.25));
            }

        /*
         * [Y,Y,Y,Y,Y,Y,(X),(X),Y,Y] => [Y,Y,Y,Y,Y,Y,,,,,,,,(X),(X),Y,Y]
         */
        } else if ($this->length == $this->capacity) {
            $first = $this->offset % $this->capacity;
            $newCap = intval($this->capacity * ($this->capacity < 1000 ? 1.5 : 1.25));

            for ($i=$this->capacity-1,$x=$newCap-1; $i >= $first; $i--,$x--) {
                $this->data->transaction(
                    DataTable::T_SET,
                    $x,
                    $this->data->transaction(DataTable::T_RPL, $i, null)
                );
            }

            $this->offset = $first + ($newCap - $this->capacity);
            $this->capacity = $newCap;
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Stackable")]
    public function push(mixed $value): void {
        if ($this->length == $this->capacity) {
            $this->expandDataset();
        }

        $this->data->transaction(
            DataTable::T_SET,
            ($this->offset + ($this->length++)) % $this->capacity,
            $value
        );
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Stackable")]
    public function pop(): mixed {
        $value = null;

        if ($this->length > 0) {
            /*
             * We replace the value rather than just retrieving it, so that possible
             * objects can be recycled.
             */
            $value = $this->data->transaction(
                DataTable::T_RPL,
                $this->offset,
                null
            );

            $this->length--;
            $this->offset = (++$this->offset) % $this->capacity;

            if ($this->length == 0) {
                $this->clear();
            }
        }

        return $value;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Stackable")]
    public function clear(): void {
        $this->data->transaction(DataTable::T_CLR);
        $this->length = 0;
        $this->offset = 0;
        $this->capacity = 100;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Stackable")]
    public function length(): int {
        return $this->length;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Stackable")]
    public function toArray(): array {
        $array = [];

        for ($i=0; $i < $this->length; $i++) {
            $array[] = $this->data->transaction(
                DataTable::T_GET,
                ($this->offset + $i) % $this->capacity
            );
        }

        return $array;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Stackable")]
    public function copy(callable $sort = null): static {
        $new = clone $this;

        if ($sort != null) {
            $new->data->transaction(DataTable::T_CLR);

            for ($i=0; $i < $this->length; $i++) {
                $key = ($this->offset + $i) % $this->capacity;
                $value = $this->data->transaction(DataTable::T_GET, $key);

                if ( ! $sort($key, $value) ) {
                    continue;
                }

                $new->push($value);
            }
        }

        return $new;
    }
}
