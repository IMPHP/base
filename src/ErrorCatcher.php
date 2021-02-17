<?php declare(strict_types=1);
/*
 * This file is part of the IMPHP Project: https://github.com/IMPHP
 *
 * Copyright (c) 2019 Daniel Bergløv, License: MIT
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

namespace im;

use ErrorException;
use Throwable;
use Closure;

/**
 * Try running some code while catching any errors.
 *
 * This class can be used to catch errors, warning and exceptions
 * while trying to run some code. The main objective here, is to
 * catch internal errors and warnings that is triggered by some of the old-school
 * code in PHP, rather than having it printet to stdout.
 */
class ErrorCatcher {

    /** @ignore */
    protected ?Throwable $mException = null;

    /** @ignore */
    protected bool $mAlwaysThrow;

    /** @ignore */
    protected Closure $mHandler;

    /**
     * @param $throwOnError
     *      If true, the code will stop at the first error or warning being triggered
     */
    public function __construct(bool $throwOnError = true) {
        $this->mAlwaysThrow = $throwOnError;
        $this->mHandler = Closure::fromCallable(function($severity, $message, $filename, $lineno){
            $this->mException = new ErrorException($message, 0, $severity, $filename, $lineno);

            if ($this->mAlwaysThrow) {
                throw $this->mException;
            }

            return true;

        })->bindTo($this);
    }

    /**
     * Try running a callable.
     *
     * This method will return whatever value is returned by the callback on success.
     * If an error or warning is triggered, an `ErrorException` will be provided
     * with the information from the error. If an exception is trown inside the code, the
     * trown exception will be provided.
     *
     * @param $callable
     *      A `callable` to run.
     *
     * @return
     *      Returns the value that was returned from the callable or `NULL`
     *      if it failed due to an error. You can check `getException`
     *      to see if there was an error. 
     */
    public function run(callable $callable): mixed {
        $this->mException = null;

        set_error_handler($this->mHandler);

        try {
            return $callable();

        } catch (Throwable $e) {
            $this->mException = $e;

        } finally {
            restore_error_handler();
        }

        return null;
    }

    /**
     * Get the exception from last run
     *
     * @return
     *      Returns `null` if the last run was successful
     */
    public function getException(): ?Throwable {
        return $this->mException;
    }
}
