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

namespace im\debug;

/**
 * Easily get the execution time for a portion of your code.
 *
 * This class allows you to add as many markers as you'd like, which
 * will be used to calculate an average time from the marked beginning.
 *
 * @example
 *      ```php
 *      $ext = new ExecutionTime();
 *      $ext->begin();
 *
 *      for ( ... ) {
 *          // Code to run
 *
 *          $ext->mark(); // Mark this execution round
 *      }
 *
 *      echo "Average time: {$ext->getTime()} ms";
 *      ```
 */
class ExecutionTime {

    /** @internal */
    protected array $time = [0];

    /**
     * Get the average time from `begin` to each `mark`.
     *
     * @return
     *      This will return the average execution time from each marker in milliseconds.
     */
    public function getTime(): int {
        $time = 0;
        $cnt = count($this->time);

        if ($cnt == 1) {
            $this->mark();
        }

        for ($i=1,$x=0; $i < $cnt; $i++,$x++) {
            $time += ($this->time[$i] - $this->time[$x]);
        }

        return $cnt > 1 ? intval($time / (($cnt - 1) * 1e+6)) : 0; // 1e+6 to convert from ns to ms
    }

    /**
     * Run a test for `$rounds` times and return the average execution time.
     *
     * @example
     *      ```php
     *      $ext = new ExecutionTime();
     *      $time = $ext->run(10, function(){
     *          // Code to run
     *      });
     *
     *      echo "Average time: $time ms";
     *      ```
     *
     * @param $rounds
     *      Times to run the test
     *
     * @param $test
     *      A callable to call on each round
     *
     * @return
     *      This will return the average execution time in milliseconds.
     */
    public function run(int $rounds, callable $test): int {
        $this->begin();

        while ($rounds-- > 0) {
            $test();
            $this->mark();
        }

        return $this->getTime();
    }

    /**
     * Mark the beginning
     */
    public function begin(): void {
        $this->time = [hrtime(true)];
    }

    /**
     * Add a mark that will track from last mark or the beginning.
     */
    public function mark(): void {
        $this->time[] = hrtime(true);
    }

    /**
     * @php
     */
    public function __toString(): string {
        return "{$this->getTime()} ms";
    }
}
