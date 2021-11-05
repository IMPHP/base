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

/**
 * A FIFO Stack (Queue) implementation
 */
class FIFOStack extends Stackable {

    /**
     * @param $capacity
     *      Set the initializesd capacity.
     */
    public function __construct(int $capacity = 0) {
        parent::__construct();

        $this->dataset["capacity"] = $capacity < 100 ? 100 : $capacity;
        $this->dataset["_capacity"] = $this->dataset["capacity"];
        $this->dataset["offset"] = 0;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    function clear(): void {
        $capacity = $this->dataset["_capacity"];

        parent::clear();

        $this->dataset["capacity"] = $capacity;
        $this->dataset["_capacity"] = $capacity;
        $this->dataset["offset"] = 0;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    public function toArray(): array {
        $array = [];

        for ($i=0; $i < $this->dataset["length"]; $i++) {
            $loc = ($this->dataset["offset"] + $i) % $this->dataset["capacity"];
            $array[] = $this->dataset["table"][$loc];
        }

        return $array;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Collection")]
    public function copy(callable $sort = null): static {
        $new = clone $this;

        if ($sort != null) {
            $new->clear();

            for ($i=0; $i < $this->length; $i++) {
                $loc = ($this->dataset["offset"] + $i) % $this->dataset["capacity"];
                $value = $this->dataset["table"][$loc];

                if ( ! $sort(null, $value) ) {
                    continue;
                }

                $new->push($value);
            }
        }

        return $new;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Stackable")]
    public function push(mixed $value): void {
        if ($this->dataset["length"] == $this->dataset["capacity"]) {
            $this->expandDataset();
        }

        $loc = ($this->dataset["offset"] + ($this->dataset["length"]++)) % $this->dataset["capacity"];
        $this->dataset["table"][$loc] = $value;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Stackable")]
    public function pop(): mixed {
        if ($this->dataset["length"] > 0) {
            $loc = $this->dataset["offset"];
            $val = $this->dataset["table"][$loc];

            $this->dataset["table"][$loc] = null;
            $this->dataset["offset"] = (++$this->dataset["offset"]) % $this->dataset["capacity"];
            $this->dataset["length"]--;

            if ($this->dataset["length"] == 0
                    && $this->dataset["capacity"] != $this->dataset["_capacity"]) {

                $this->clear(); // Reduce capacity, if it was expanded
            }

            return $val;
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Stackable")]
    public function peak(): mixed {
        return $this->dataset["table"][$this->dataset["offset"]] ?? null;
    }

    /**
     * @internal
     */
    protected function expandDataset(): void {
        $length = $this->dataset["length"];
        $offset = $this->dataset["offset"];
        $capacity = $this->dataset["capacity"];

        /*
         * [9,10,1,2,3,4,5,6,7,8] => [,,1,2,3,4,5,6,7,8,9,10,,,,,,,,]
         */
        if ($length >= $capacity && $offset < (int) ($capacity / 2)) {
            $newCap = intval($capacity * ($capacity < 1000 ? 1.5 : 1.25));

            if ($offset > 0) {
                $last = (($offset + $length) % $capacity) - 1;

                if ($last >= ($newCap - $capacity)) {
                    $newCap = $capacity + $last + 1;
                }

                for ($i=0,$x=$capacity; $i <= $last; $i++,$x++) {
                    $this->dataset["table"][$x] = $this->dataset["table"][$i];
                    $this->dataset["table"][$i] = null;
                }
            }

            $this->dataset["capacity"] = $newCap;

        /*
         * [5,6,7,8,9,10,1,2,3,4] => [5,6,7,8,9,10,,,,,,,,1,2,3,4]
         */
        } else if ($length >= $capacity) {
            $first = $offset % $capacity;
            $newCap = intval($capacity * ($capacity < 1000 ? 1.5 : 1.25));

            for ($i=$capacity-1,$x=$newCap-1; $i >= $first; $i--,$x--) {
                $this->dataset["table"][$x] = $this->dataset["table"][$i];
                $this->dataset["table"][$i] = null;
            }

            $this->dataset["offset"] = $first + ($newCap - $capacity);
            $this->dataset["capacity"] = $newCap;
        }
    }
}
