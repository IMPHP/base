<?php declare(strict_types=1);
/*
 * This file is part of the IMPHP Project: https://github.com/IMPHP
 *
 * Copyright (c) 2016 Daniel Bergløv, License: MIT
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

namespace im\io;

use im\io\res\StreamDecorator;
use im\ErrorCatcher;
use Exception;

/**
 * A stream implementation that can lazyly open files.
 *
 * This is mostly the same as `RawStream`. The differences are:
 *
 *  - You don't have to manually create a resource and parse it to the stream.
 *  - It has the option to lazily open the path when/if it's needed.
 *
 * @example
 *
 *      ```php
 *      $stream = new FileStream($path, '+r', true);
 *
 *      foreach (($line = $stream->readLine()) !== null) { // File is opened here
 *          printf("%s\n", $line);
 *      }
 *
 *      $stream->close();
 *      ```
 */
class FileStream implements Stream {

    use StreamDecorator;

    /** @ignore */
    protected string $mFilePath;

    /** @ignore */
    protected string $mFileMode;

    /**
     *
     */
    public function __construct(string $file, string $mode = Stream::DEF_MODE, bool $lazy = false) {
        $this->mFilePath = $file;
        $this->mFileMode = $mode;

        if (!$lazy) {
            $this->stream = $this->createStream();
        }
    }

    /**
     * @ignore
     */
    public function __get(string $name) {
        if ($name == "stream") {
            return ($this->stream = $this->createStream());
        }

        throw new Exception("Undefined property via __get(): $name");
    }

    /**
     * @ignore
     */
    protected function createStream(): Stream {
        $file = $this->mFilePath;
        $mode = $this->mFileMode;
        $catcher = new ErrorCatcher();

        /*
         * fopen may trigger a warning if it fails.
         * Capture it and turn it into a proper exception.
         */
        $stream = $catcher->run(function() use ($file, $mode): Stream {
            return new RawStream( fopen($file, $mode) );
        });

        if ($stream == null) {
            throw $catcher->getException();
        }

        return $stream;
    }
}
