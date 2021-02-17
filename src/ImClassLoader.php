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

if (!interface_exists("im\\ClassLoader", false)) {
    require "ClassLoader.php";
}

use Closure;
use Exception;

/**
 * An implementation of the `ClassLoader` interface.
 *
 * This ClassLoader implements features such as `PSR0` and `PSR4` lookup,
 * it supports class map files for caching and encresed speed along with
 * prefixes and more.
 */
final class ImClassLoader implements ClassLoader {

    /** @ignore */
    private /*?callable*/ $mAutoload = null;

    /** @ignore */
    private array $mClassExtensions = ["php"];

    /** @ignore */
    private array $mClassPrefixes = [];

    /** @ignore */
    private array $mClassMaps = [];

    /** @ignore */
    private array $mBasePaths = [];

    /** @ignore */
    private static ?ImClassLoader $INST = null;

    /**
     * Quick load the ClassLoader statically
     *
     * @return
     *      The instance created via this method
     */
    public static function load(): static {
        if (static::$INST === null) {
            static::$INST = new static();
            static::$INST->enableAutoload();
        }

        return static::$INST;
    }

    /**
     *
     */
    public function __construct() {
        /* Also add the base directory as a source
         */
        $this->addBasePath(__DIR__);
        $this->addClassPrefix("im\\", "");
    }

    /**
     * Add a new class extension to search for
     *
     * By default the loader searches for class files with extension
     * 'php'.
     *
     * @note
     *      Class extensions has no affect on class maps.
     *      This only affects PSR0/PSR4 searches.
     *
     * @param $extension
     *      File extension to add
     */
    public function addClassExtension(string $extension): void {
        if (!in_array($extension, $this->mClassExtensions)) {
            $this->mClassExtensions[] = $extension;
        }
    }

    /**
     * Add a new PSR4 prefix to the class search
     *
     * This works like a form of alias and the result is not meant to produce
     * a complete path. All class files are treated as relative to one of the
     * defiend class paths using `addClassPath()`. The purpose is
     * to make changes to the beginning of namespaces, to redirect it
     * to a different sub-path.
     *
     * For example:
     *
     * ```
     * my\namespace => my\namespace\src       >> [my\namespace\Class -> my/namespace/src/Class.php]
     * my\other\namespace => my\namespace     >> [my\other\namespace\Class -> my/namespace/Class.php]
     * ```
     *
     * @param $prefix
     *      The part of the namespace to replace
     *
     * @param $localDir
     *      The new part to replace it with
     */
    public function addClassPrefix(string $prefix, string $localDir): void {
        $prefix = str_replace("/", "\\", $prefix);
        $localDir = str_replace("\\", "/", $localDir);

        foreach ($this->mClassPrefixes as [$key, $value]) {
            if ($key == $prefix && $value == $localDir) {
                return;
            }
        }

        $this->mClassPrefixes[] = [$prefix, $localDir];
    }

    /**
     * Add a class map
     *
     * The class map should be a mapped array
     * where class name is the key and file path the value.
     *
     * @param $basePath
     *      Optional base path that is added to the class paths in the map
     *
     * @param $map
     *      Mapped array where key is full class name and value is
     *      the file path relative to $basePath.
     */
    public function addClassMap(?string $basePath, array $map): void {
        if (!empty($map)) {
            if (empty($basePath) || is_dir($basePath)) {
                $this->mClassMaps[] = [
                    !empty($basePath) ? realpath($basePath) : null,
                    $map
                ];

            } else {
                throw new Exception("The class map base path '$basePath' does not exist");
            }
        }
    }

    /**
     * Load a class map from a file.
     *
     * @note
     *      A class map file is a PHP file that returns an array
     *      with all the mappings.
     *
     * @param $file
     *      Path to a file containing a proper classmap PHP array.
     *      The maps should be relative to the files location.
     */
    public function loadClassMap(string $file): void {
        if (is_file($file)) {
            $dir = realpath(dirname($file));
            $map = _im_include($file);

            if (!is_array($map)) {
                throw new Exception("The class map file '$file' does not contain a proper PHP array");
            }

            $this->addClassMap($dir, $map);

        } else {
            throw new Exception("The class map file '$file' does not exist");
        }
    }

    /**
     * Add a new base path containing classes to load
     *
     * Base paths are paths where this loader searches
     * for classes. Each part of a class namespace should be resolved
     * to folders, starting in the root of one of the base paths.
     *
     * Classes outside of namespaces will be searched for
     * in the root of the base paths.
     *
     * @example
     *
     *      ```php
     *      $loader->addBasePath("./src"); // Class "im\util\Map" would be located in "./src/im/util/Map.php" depending on prefixes
     *      ```
     *
     * @param $path
     *      Base search path
     */
    public function addBasePath(string $path): void {
        if (is_dir($path)) {
            $path = realpath($path);

            if (!in_array($path, $this->mBasePaths)) {
                $this->mBasePaths[] = $path;
            }

        } else {
            throw new Exception("The class path '$path' does not exist");
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\ClassLoader")]
    function findClass(string $class): ?string {

        /* Start by looking in the static class maps
         */
        foreach ($this->mClassMaps as [$basePath, $map]) {
            if (isset($map[$class])) {
                return $basePath != null ? sprintf("%s/%s", $basePath, $map[$class]) : $map[$class];
            }
        }

        /* No class file found.
         * Start searching for it, unless we don't have any base paths defined for the search.
         */
        if (!empty($this->mBasePaths)) {
            $localFiles = [];
            $localPath = ltrim(str_replace("\\", "/", $class), "/");

            /* Build local file path for each file extension
             */
            foreach ($this->mClassExtensions as $extension) {
                $localFile = sprintf("%s.%s", $localPath, $extension);

                /* PSR4 Prefixes
                 */
                if (strpos($localFile, "/") !== false) {
                    foreach ($this->mClassPrefixes as [$prefix, $alias]) {
                        if (strpos($class, $prefix) === 0) {
                            $localFiles[] = ltrim(sprintf("%s%s", $alias, substr($localFile, strlen($prefix))), "/");
                        }
                    }
                }

                /* PSR0/PSR4
                 */
                $localFiles[] = $localFile;
            }

            /* Start searching each registered class path
             */
            foreach ($localFiles as $localFile) {
                foreach ($this->mBasePaths as $basePath) {
                    $file = sprintf("%s/%s", $basePath, $localFile);

                    if (is_file($file)) {
                        return $file;
                    }
                }
            }
        }

        return null;
    }

    /**
     * Enable class auto loading
     */
    public function enableAutoload(): bool {
        if ($this->mAutoload == null) {
            $this->mAutoload = Closure::bind(
                function($class){
                    $file = $this->findClass($class);

                    if ($file != null) {
                        _im_include($file);
                    }
                },
                $this
            );

            spl_autoload_register($this->mAutoload);
        }

        return true;
    }

    /**
     * Disable class auto loading
     */
    public function disableAutoload(): bool {
        if ($this->mAutoload != null) {
            if(spl_autoload_unregister($this->mAutoload)) {
                $this->mAutoload = null;

            } else {
                return false;
            }
        }

        return true;
    }
}

/**
 * Internal function to include class files
 * in a clean scope.
 *
 * @internal
 */
function _im_include(string $file): mixed {
    return require $file;
}
