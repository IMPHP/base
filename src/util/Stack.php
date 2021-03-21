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
 * also popping them from the top.
 *
 * @note
 *      The iterator in this class will pop all returned values.
 *      This means that you can simply iterate through the stack to
 *      pop them in the correct order. It also means that you will loop
 *      forever if you push values during iteration.
 */
class Stack extends Stackable {

    /** @internal */
    protected int $length = 0;

    /**
     * @php
     */
    public function __serialize(): array {
        return [
            "data" => $this->mData->__serialize(),
            "length" => $this->length
        ];
    }

    /**
     * @php
     */
    public function __unserialize(array $data): void {
        parent::__unserialize($data["data"] ?? []);

        $this->length = $data["length"] ?? 0;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Stackable")]
    public function push(mixed $value): void {
        $this->data->transaction(DataTable::T_SET, $this->length++, $value);
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
            $value = $this->data->transaction(DataTable::T_RPL, --$this->length, null);

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
    public function get(): mixed {
        if ($this->length > 0) {
            return $this->data->transaction(DataTable::T_GET, $this->length - 1);
        }

        return null;
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
                $value = $this->data->transaction(DataTable::T_GET, $i);

                if ( ! $sort($i, $value) ) {
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
    public function clear(): void {
        $this->data->transaction(DataTable::T_CLR);
        $this->length = 0;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\util\Stackable")]
    public function length(): int {
        return $this->length;
    }
}
