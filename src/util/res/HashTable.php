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

use Traversable;

/**
 * Extension to `DataTable` that allows using multiple data types as key.
 *
 * This DataTable extenstion enables key hashing, allowing the usage of
 * other data types as keys. Normally only `string` and `int` is allowed.
 *
 * @deprecated
 *      This class is no longer used by the `Collection` classes
 *      and has been deprecated.
 */
abstract class HashTable extends LockTable {

    /** @ignore */
    protected array $mKeys = [];

    /**
     * @internal
     */
    protected function hash(mixed $obj): string {
        if (is_object($obj)) {
            return spl_object_hash($obj);

        } else {
            return md5(serialize($obj));
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\res\DataTable")]
    public function transaction(int $code, mixed $key = null, mixed $value = null): mixed {
        $HashKey = $key != null ? $this->hash($key) : null;
        $result = parent::transaction($code, $HashKey, $value);

        switch ($code) {
            case DataTable::T_RPL:
            case DataTable::T_SET: $this->mKeys[$HashKey] = $key; break;
            case DataTable::T_DEL: unset($this->mKeys[$HashKey]); break;
            case DataTable::T_CLR: $this->mKeys = []; break;
            case DataTable::T_LOC:
                                    if ($result != null) {
                                        $result = $this->mKeys[$result];
                                    }

                                    break;

            case DataTable::T_ITR:
                return (function(): Traversable {
                    foreach ($this->mData as $key => $value) {
                        yield $this->mKeys[$key] => $value;
                    }
                })();
        }

        return $result;
    }

    /**
     * @php
     */
    public function __serialize(): array {
        $data = parent::__serialize();
        $data["keys"] = $this->mKeys;
    }

    /**
     * @php
     */
    public function __unserialize(array $data): void {
        parent::__unserialize($data);

        $this->mKeys = $data["keys"] ?? [];
    }
}
