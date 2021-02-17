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
use im\util\res\HashTable;
use Exception;

/**
 * An implementation of the `MapArray` interface.
 *
 * This class is an extension of the `Map` class that adds
 * support for keys of multiple datatypes. Normally a map only
 * supports `string` as a key, however this class extends this by allowing
 * any type to be used, even an object. 
 */
class HashMap extends Map {

    /**
     * @internal
     */
    #[Override("im\util\Map")]
    protected function createDataTable(): DataTable {
        return new class() extends HashTable {};
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Map")]
    public function addIterable(iterable $list): void {
        foreach ($list as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Map")]
    public function get(mixed $key, mixed $defVal = null): mixed {
        return $this->mData->transaction(DataTable::T_GET, $key) ?? $defVal;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Map")]
    public function set(mixed $key, mixed $value): void {
        $this->mData->transaction(DataTable::T_SET, $key, $value);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Map")]
    public function unset(mixed $key): mixed {
        $value = $this->mData->transaction(DataTable::T_GET, $key);
        $this->mData->transaction(DataTable::T_DEL, $key);

        return $value;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Map")]
    public function isset(mixed $key): bool {
        return $this->mData->transaction(DataTable::T_CHK, $key);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\utils\Map")]
    function toArray(): array {
        throw new Exception("This map cannot be converted into PHP Arrays");
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Map")]
    function equals(object $other): bool {
        throw new Exception("Comparing against this map type has not been implemented yet");
    }
}
