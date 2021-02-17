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

use Closure;
use Exception;

/**
 * An extended stdClass-like class
 *
 * The major purpose with this class, is to provide a better interface
 * to be used as a replacement for PHP's stdClass. What that means is that
 * although stdClass is great when you need an object with a few properties,
 * it's main purpose is to be used for convertion of arrays to objects.
 *
 * Struct is mosly meant to be used just like you would stdClass.
 * But the interface itself is a better datatype to parse between classes and methods,
 * because it does not signal the likelyhood of an array casting. So when it comes down to
 * stdClass vs Struct, it's mostly just the separation of the purpose.
 *
 * Of cause that does not mean that we can't add a little extra spices to Struct
 * while we're add it. So what does it do that stdClass does'nt?
 *
 *    1. Quick/Easy instantiation of all the keys that should be available.
 *    2. Quick/Easy filling of default values.
 *    3. Optional invoke callable can be added with access to `$this` and internal data storage.
 *    4. Only registered keys can be used.
 *
 * The above features extends the posibilities a bit.
 *
 *    1. You can use this purely as an stdClass replacement.
 *    2. You can use this as an stdClass replacement with a callable to do something with it's content.
 *    3. You can use this as a callable replacement that allows you to store internal data for the next time it's being invoked.
 *
 * @example
 *
 *      ```php
 *      // Initialize the keys that will be available with 'NULL value'
 *      $struct = Struct::factory("key1", "key2", "key3");
 *
 *      // Fill keys with real values, must come in the same order as the keys.
 *      $struct->fill("Some text", 10, true);
 *
 *      // Change a single key value
 *      $struct->key1 = "Another text";
 *
 *      // Create a new struct equal to the one creating it. The values are optional.
 *      $newStruct = $struct->makeNew("New text", 25, false);
 *
 *      // Register an invoke callable to the new struct
 *      $newStruct->setOnInvoke(function(){ return $this->key2; });
 *
 *      // Call the new struct
 *      $key2 = $newStruct();
 *      ```
 */
class Struct {

    /**
     * A property that can be used by invoke callables to store data between calls
     *
     * The Struct is not to be confused with an easy way to create
     * class objects. It's a simple storage class to optain multiple values
     * much like a map, but more object-like. It has an invoke feature allowing
     * a single callable to be invoked on the object, and some times this callable may
     * want to store a little bit of data, which a single property should be able to do
     * just fine. It can always be assigned as a Struct itself, stdClass or array for multiple
     * key/value pairs.
     */
    protected mixed $memory;

    /** @internal */
    private array $__properties = [];

    /** @internal */
    private /*closure*/ $__closure;

    /**
     * @internal
     * @php
     */
    public function __invoke(/*mixed*/ ...$args) {
        if ($this->__closure != null) {
            return ($this->__closure)(...$args);
        }

        throw new Exception("No Struct invoke callable has been registered");
    }

    /**
     * @internal
     * @php
     */
    public function __set(/*string*/ $key, /*mixed*/ $value) {
        if (array_key_exists($key, $this->__properties)) {
            $this->__properties[$key] = $value;

        } else {
            print_r($this->__properties);
            throw new Exception("The Struct key '$key' has not been initialized");
        }
    }

    /**
     * @internal
     * @php
     */
    public function &__get(/*string*/ $key) {
        if (array_key_exists($key, $this->__properties)) {
            return $this->__properties[$key];
        }

        throw new Exception("The Struct key '$key' has not been initialized");
    }

    /**
     * @internal
     * @php
     */
    public function __isset(/*string*/ $key) {
        return isset($this->__properties[$key]);
    }

    /**
     *
     */
    private function __construct() {}

    /**
     * Initialize a single key.
     *
     * This allows you to initialize a single key, after the object
     * has been created.
     *
     * @example
     *
     * ```php
     * $struct = new Struct();
     * $struct->initialize("myKey");
     * $struct->myKey = "Some value";
     * ```
     *
     * @param $key
     *      The key to initialize
     */
    public function initialize(string $key): void {
        if (!array_key_exists($key, $this->__properties)) {
            $this->__properties[$key] = null;

        } else {
            throw new Exception("The Struct key '$key' has already been initialized");
        }
    }

    /**
     * Add a callable that will be called when trying to access this
     * instance as a function.
     *
     * @example
     *
     * ```php
     * $struct = new Struct();
     * $struct->setOnInvoke(function(){
     *      // Action to perform
     * });
     *
     * $struct(); // Invoke the function
     * ```
     *
     * @param $callable
     *      A callable to be invoked.
     */
    public function setOnInvoke(callable $callable): static {
        if ($callable != null) {
            if (!is_object($callable) || !($callable instanceof Closure)) {
                $callable = Closure::fromCallable($callable);
            }

            $this->__closure = $callable->bindTo($this);

        } else {
            $this->__closure = null;
        }

        return $this;
    }

    /**
     * Create a `Struct` with multiple keys already initialized.
     *
     * @example
     *
     * ```php
     * $struct = Struct::factory("key1", "key2");
     * $struct->key1 = "Some value";
     * $struct->key2 = "Some value";
     * ```
     *
     * @param $keys
     *      Keys to initialize
     *
     * @return
     *      A new instance with specified keys initialized
     */
    public static function factory(string ...$keys): static {
        $ret = new static();

        foreach ($keys as $key) {
            $ret->__properties[$key] = null;
        }

        return $ret;
    }

    /**
     * Fill all initialized keys with values.
     *
     * @example
     *
     * ```php
     * $struct = Struct::factory("key1", "key2");
     * $struct->fill("Some value", "Some value");
     * ```
     *
     * @param $values
     *      Values to assign
     *
     * @return
     *      Returns the same instance
     */
    public function fill(mixed ...$values): static {
        foreach (array_keys($this->__properties) as $pos => $key) {
            if ($pos >= count($values)) {
                break;
            }

            $this->__properties[$key] = $values[$pos];
        }

        return $this;
    }

    /**
     * Create a new instance with the same initialized keys.
     *
     * @example
     *
     * ```php
     * $struct = Struct::factory("key1", "key2");
     * $struct->fill("Some value", "Some value");
     * $struct2 = $struct->makeNew("Some new value", "Some new value");
     *
     * $struct->key1 // Some value
     * $struct2->key1 // Some new value
     * ```
     *
     * @param $values
     *      Values to assign
     *
     * @return
     *      The new instance
     */
    public function makeNew(mixed ...$values): static {
        $keys = array_keys($this->__properties);
        $new = static::factory(...$keys);

        foreach (array_keys($this->__properties) as $pos => $key) {
            $new->__properties[$key] = $pos < count($values) ? $values[$pos] : $this->__properties[$key];
        }

        if ($this->__closure != null) {
            $new->setOnInvoke($this->__closure);
        }

        return $new;
    }
}
