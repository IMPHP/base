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
 * This extended `ExecutionTime` uses PHP's `getrusage()` to get execution time from the system call.
 *
 * This can be useful if you want to be able to distinguish between user and system time.
 * However this does not play well on some platforms or on code begin run on virtual machines.
 */
class SystemTime extends ExecutionTime {

    /** @internal */
    protected array $systemTime = [0];

    /** @internal */
    protected array $userTime = [0];

    /**
     * @inheritDoc
     */
    #[Override("im\debug\ExecutionTime")]
    public function getTime(): int {
        return $this->getUserTime() + $this->getSystemTime();
    }

    /**
     * Get the average user time.
     */
    public function getUserTime(): int {
        $time = 0;
        $cnt = count($this->userTime);

        if ($cnt == 1) {
            $this->mark();
        }

        for ($i=1,$x=0; $i < $cnt; $i++,$x++) {
            $time += ($this->userTime[$i] - $this->userTime[$x]);
        }

        return $cnt > 1 ? intval($time / ($cnt - 1)) : 0;
    }

    /**
     * Get the average system time. 
     */
    public function getSystemTime(): int {
        $time = 0;
        $cnt = count($this->systemTime);

        if ($cnt == 1) {
            $this->mark();
        }

        for ($i=1,$x=0; $i < $cnt; $i++,$x++) {
            $time += ($this->systemTime[$i] - $this->systemTime[$x]);
        }

        return $cnt > 1 ? intval($time / ($cnt - 1)) : 0;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\debug\ExecutionTime")]
    public function begin(): void {
        $ru = getrusage();

        $this->userTime = [($ru["ru_utime.tv_sec"] * 1000) + intval($ru["ru_utime.tv_usec"] / 1000)];
        $this->systemTime = [($ru["ru_stime.tv_sec"] * 1000) + intval($ru["ru_stime.tv_usec"] / 1000)];
    }

    /**
     * @inheritDoc
     */
    #[Override("im\debug\ExecutionTime")]
    public function mark(): void {
        $ru = getrusage();

        $this->userTime[] = ($ru["ru_utime.tv_sec"] * 1000) + intval($ru["ru_utime.tv_usec"] / 1000);
        $this->systemTime[] = ($ru["ru_stime.tv_sec"] * 1000) + intval($ru["ru_stime.tv_usec"] / 1000);
    }
}
