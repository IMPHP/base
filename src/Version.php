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
namespace im;

use Exception;
use Stringable;

/**
 * Semantic Version extraction and comparison
 *
 * This class can be used to compare two semantic version strings and/or
 * retrieve information from a version string. It splits a version into
 * several parts of which each part can be extracted individually.
 *
 * __Version Scheme__
 *
 * | Description                                                      | Example               |
 * | ---------------------------------------------------------------- | --------------------- |
 * | \<major>[.\<minor>[.\<patch>]][-\<release>][.\<build>][+\<meta>] | 1.0.0-beta.1+20220130 |
 *
 * @note
 *      All of the properties are readonly and will return a default value if the version string
 *      did not include that part. To see if a specific part of the version was actually included
 *      you can use `isset()`.
 *
 * @var int $major
 * @var int $minor
 * @var int $patch
 * @var int $build
 * @var string $release
 * @var string|null $meta
 * @var string $version
 */
 class Version implements Stringable {

     /** @ignore */
     const RX_SCAN = '/^(?<x>[0-9]+)(?:\.(?<y>[0-9]+))?(?:\.(?<z>[0-9]+))?(?:[-_\.](?<r>[A-Za-z]+))?(?:[-_\.]?(?<b>[0-9]+))?(?:\+(?<m>.+))?$/';

     /** @ignore */
     protected int|null $_major;

     /** @ignore */
     protected int|null $_minor;

     /** @ignore */
     protected int|null $_patch;

     /** @ignore */
     protected string|null $_meta;

     /** @ignore */
     protected string|null $_release;

     /** @ignore */
     protected int|null $_build;

     /**
      * Validate a version based on a rule set
      *
      * You can validate by adding multiple `AND`/`OR` statements using `||` and spaces.
      *
      * @example
      *     ```php
      *     Version::validate($version, ">=2.0.0 !=2.2.0 < 3.0 || >4.0");
      *     ```
      *
      * @example
      *     ```php
      *     Version::validate($version, "~2.2.0");
      *     ```
      */
     public static function validate(string|Version $version, string $rule): bool {
         if (is_string($version)) {
             $version = new static($version);
         }

         $andRules = preg_split("/\s+\|\|\s+/", $rule);
         $valid = false;

         foreach ($andRules as $andRule) {
             $orRules = preg_split("/\s+/", $andRule);

             foreach ($orRules as $orRule) {
                 if (preg_match("/^\>=|\<=|\>|\<|=|!=|\^|~/", $orRule, $match)) {
                     $operator = $match[0];
                     $orRule = substr($orRule, strlen($operator));

                 } else {
                     $operator = "=";
                 }

                 $rule = new static($orRule);

                 if (!($valid = $version->compare($rule, $operator))) {
                     continue 2;
                 }
             }

             if ($valid) {
                 break;
             }
         }

         return $valid;
     }

     /**
      * @param $version
      *     A version string
      */
     public function __construct(string $version) {
         if (preg_match(Version::RX_SCAN, $version, $match)) {
             $this->_major = (int) $match["x"];
             $this->_minor = isset($match["y"]) && $match["y"] != "" ? ((int) $match["y"]) : null;
             $this->_patch = isset($match["z"]) && $match["z"] != "" ? ((int) $match["z"]) : null;
             $this->_build = isset($match["b"]) && $match["b"] != "" ? ((int) $match["b"]) : null;
             $this->_release = $match["r"] ?? null;
             $this->_meta = $match["m"] ?? null;

         } else {
             throw new Exception("Invalid version: $version");
         }
     }

     /**
      * @ignore
      * @php
      */
     public function __toString(): string {
         return $this->version;
     }

     /**
      * @ignore
      * @php
      */
     public function __isset(/*string*/ $name) /*bool*/ {
         switch ($name) {
             case "version": return true;
             default:
                $name = "_{$name}";

                return isset($this->$name);
         }
     }

     /**
      * @ignore
      * @php
      */
     public function __get(/*string*/ $name) /*mixed*/ {
         switch ($name) {
             case "major": return $this->_major;
             case "minor": return $this->_minor ?? 0;
             case "patch": return $this->_patch ?? 0;
             case "build": return $this->_build ?? 0;
             case "release": return $this->_release ?? "stable";
             case "meta": return $this->_meta;

             case "version":
                     $version = $this->_major;
                     $version .= sprintf(".%s", $this->_minor ?? 0);
                     $version .= sprintf(".%s", $this->_patch ?? 0);

                     if (!empty($this->_release)) {
                         $version .= "-{$this->_release}";
                     }

                     if (!empty($this->_build) && $this->_build != 0) {
                         $version .= ".{$this->_build}";
                     }

                     return $version;
         }

         $trace = debug_backtrace();

         throw new RuntimeException(
             'Undefined property via '. get_class($this) .'__get(): ' . $name .
             ' in ' . $trace[0]['file'] .
             ' on line ' . $trace[0]['line']
         );
     }

     /**
      * Compare two versions
      *
      * __Operators__
      *
      * | Operator | Description         |
      * | -------- | ------------------- |
      * | =        | Equal to            |
      * | !=       | Not equal to        |
      * | >        | Grater than         |
      * | <        | Smaller than        |
      * | >=       | Grater or equal to  |
      * | <=       | Smaller or equal to |
      * | ^        | Caret range         |
      * | ~        | Tilde range         |
      *
      * @note
      *     The Caret and Tilde range options are based on Composers operators.
      *
      * @param $version
      *     A version to compare against
      *
      * @param $operator
      *     Optional operator. If `NULL` the method will return an `integer` based on the result.
      *     The values are `-1` when smaller than, `1` when grater than and `0` if both versions
      *     are equal.
      */
     public function compare(string|Version $version, string|null $operator = null): bool|int {
         if (is_string($version)) {
             $version = new static($version);
         }

         if ($operator == null) {
             return version_compare($this->version, $version->version);

         } else if (!version_compare($this->version, $version->version, ($operator == "^" || $operator == "~") ? ">=" : $operator)) {
             return false;
         }

         if ($operator == "~" || $operator == "^") {
             $major = (int) $version->major;
             $minor = (int) $version->minor;
             $patch = (int) $version->patch;
             $digits = $operator == "~" ? ["major", "minor", "patch"] : ["patch", "minor", "major"];

             if ($operator == "~") {
                 while (($c = array_pop($digits)) != null) {
                     if (isset($version->$c)) {
                         if (($d = array_pop($digits)) != null) {
                             $$c = 0;
                             $$d++;
                         }

                         break;
                     }
                 }

             } else {
                 while (($c = array_pop($digits)) != null) {
                     if ($$c > 0) {
                         $$c++;

                         while (($d = array_pop($digits)) != null) {
                             $$d = 0;
                         }

                         break;
                     }
                 }
             }

             return version_compare($this->version, "{$major}.{$minor}.{$patch}", "<");
         }

         return true;
     }
 }
