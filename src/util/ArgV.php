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

/**
 * This class provides a unified API to deal with shell arguments (argv)
 *
 * @example
 *
 *      ```sh
 *      command -abc --flag --opt1 val1 opt2=val2 -d instr1 --opt3[] val3 opt3[]=val4 -- instr2 --opt5 val5
 *      ```
 *
 *      ```php
 *      [
 *          "flags" => ['a' => true, 'b' => true, 'c' => true, 'flag' => true, 'd' => true],
 *          "options" => [
 *              "opt1" => "val1",
 *              "opt2" => "val2",
 *              "opt3" => ["val3", "val4"]
 *          ],
 *          "operands" => ["instr1", "instr2", "--opt5", "val5"]
 *      ];
 *      ```
 */
class ArgV {

    /** @internal */
    protected array $mOptions = [];

    /** @internal */
    protected array $mOperands = [];

    /** @internal */
    protected array $mFlags = [];

    /** @internal */
    protected string $mExecFile;

    /** @internal */
    protected string $mExecPath;

    /**
     * @php
     */
    public function __serialize(): array {
        return [
            "options" => $this->mOptions,
            "operands" => $this->mOperands,
            "flags" => $this->mFlags,
            "execFile" => $this->mExecFile,
            "execPath" => $this->mExecPath
        ];
    }

    /**
     * @php
     */
    public function __unserialize(array $data): void {
        $this->mOptions = $data["options"] ?? [];
        $this->mOperands = $data["operands"] ?? [];
        $this->mFlags = $data["flags"] ?? [];
        $this->mExecFile = $data["execFile"] ?? "";
        $this->mExecPath = $data["execPath"] ?? "";
    }

    /**
     * @param $args
     *      Optional argv. Defaults to PHP's $argv.
     *
     * @param $validFlags
     *      By default only character flags '-f' are supported.
     *      To enable something like '--help', you must specify ['--help']
     *      in this argument. Otherwise '--help' will be seen as an option and
     *      the next part will be seen as the value of '--help'.
     */
    public function __construct(array $args = null, array $validFlags = []) {
        if ($args === null) {
            global $argv;
            $args = &$argv;

            if (!is_array($args)) {
                $args = [];
            }
        }

        $this->mExecFile = basename($args[0]) ?? null;
        $this->mExecPath = (($path = realpath(dirname($args[0]))) !== false ? $path : dirname($args[0])) ?? null;

        $delimiter = false;

        for ($i=1,$s=0; $i < count($args); $i++) {
            $arg = $args[$i];

            if ($delimiter) {
                $this->mOperands[] = $arg;

            } else if ($arg == "--") {
                $delimiter = true;

            } else if (substr($arg, 0, 2) == "--") {
                if (in_array(($flag = substr($arg, 2)), $validFlags)) {
                    $this->mFlags[ $flag ] = true;

                } else if (isset($args[++$i])) {
                    if (substr($arg, -2) == "[]") {
                        $arg = substr($arg, 2, -2);

                        if (!isset($this->mOptions[$arg])) {
                            $this->mOptions[$arg] = [ $args[$i] ];

                        } else {
                            $this->mOptions[$arg][] = $args[$i];
                        }

                    } else {
                        $this->mOptions[ substr($arg, 2) ] = $args[$i];
                    }

                }

            } else if (substr($arg, 0, 1) == "-") {
                $arg = str_split( substr($arg, 1) );

                foreach ($arg as $flag) {
                    $this->mFlags[ $flag ] = true;
                }

            } else if (($pos = strpos($arg, "=")) !== false) {
                $val = substr($arg, $pos+1);
                $arg = substr($arg, 0, $pos);

                if (substr($arg, -2) == "[]") {
                    $arg = substr($arg, 0, -2);

                    if (!isset($this->mOptions[$arg])) {
                        $this->mOptions[$arg] = [ $val ];

                    } else {
                        $this->mOptions[$arg][] = $val;
                    }

                } else {
                    $this->mOptions[$arg] = $val;
                }

            } else {
                $this->mOperands[] = $arg;
            }
        }
    }

    /**
     * Get the name of the file that was executed
     */
    public function getScriptName(): ?string {
        return $this->mExecFile;
    }

    /**
     * Get the absolut path to the file that was executed
     */
    public function getScriptPath(): ?string {
        return $this->mExecPath;
    }

    /**
     * Get all the flags that was passed
     *
     * @see hasFlag
     * @return
     *      Returns a list of all the available flags.
     */
    public function getFlags(): MutableStructuredList {
        return new Vector( array_keys($this->mFlags) );
    }

    /**
     * Check to see if a specific flag was passed
     *
     * A flag is one that was passed as `-f`.
     * It can also be part of miltiple flags `-fg` where
     * `f` would be one flag and `g` another.
     *
     * @param $char
     *      The flag character.
     *      This does not include the '-' character
     *
     * @return
     *      Returns `true` if the flag is available or `false` otherwise
     */
    public function hasFlag(string $char): bool {
        return isset( $this->mFlags[$char] );
    }

    /**
     * Get all of the options that was passed
     *
     * @see hasOption
     * @return
     *      A map containing all of the options
     */
    public function getOptions(): MutableStringMappedArray {
        $ret = new Map();

        foreach ($this->mOptions as $key => $val) {
            if (is_array($val)) {
                $ret->set($key, new Vector($val));

            } else {
                $ret->set($key, $val);
            }
        }

        return $ret;
    }

    /**
     * Check to see if an option is available.
     *
     * An option is one that was passed as `--name value` or
     * `name=value`. It may also be multiple values using
     * `--name[] val1 --name[] val2` or `name[]=val1 name[]=val2`.
     *
     * @param $name
     *      The name of the option.
     *      This does not include any '--' that may have been used.
     *
     * @return
     *      Returns `true` if the option is available or `false` otherwise
     */
    public function hasOption(string $name): bool {
        return isset( $this->mOptions[$name] );
    }

    /**
     * Get the value from an option.
     *
     * This will not return multiple values if an option was passed with
     * multiple values. In that case it will return the first value.
     *
     * @param $name
     *      The name of the option.
     *      This does not include any '--' that may have been used.
     *
     * @see hasOption
     * @see getOptionAsList
     * @return
     *      The value if the option exist or `null` if it doesn't
     */
    public function getOption(string $name): ?string {
        if (!empty($this->mOptions[$name])) {
            return is_array($this->mOptions[$name])
                    ? $this->mOptions[$name][0] ?? null : $this->mOptions[$name];
        }

        return null;
    }

    /**
     * Get values from an option as a list
     *
     * This will always return a list of values, even if there is
     * only one value or none at all.
     *
     * @param $name
     *      The name of the option.
     *      This does not include any '--' that may have been used.
     *
     * @see hasOption
     * @see getOption
     * @return
     *      Always returns a list
     */
    public function getOptionAsList(string $name): MutableStructuredList {
        $ret = $this->mOptions[$name] ?? [];

        return new Vector( is_array($ret) ? $ret : [$ret] );
    }

    /**
     * Get a list of all of the operands
     *
     * @see getOperand
     * @return
     *      A list of operands. An empty list is returned if there is no operands.
     */
    public function getOperands(): MutableStructuredList {
        return new Vector( $this->mOperands );
    }

    /**
     * Get a specific operand by it's position relative to all passed operands.
     *
     * An operand is one that is passed alone. That means an argument that was not
     * passed as a flag '-f' or as an option '--name val'.
     *
     * The position of an operand is only counted from another operand and not
     * from any options or the script name.
     *
     * For an example:
     * ```sh
     * cmd -d --name val operand
     * ```
     * Here the position of 'operand' would be '0' or '-1' if you go for the last one.
     *
     * @param $pos
     *      Position of the operand. May be negative integer to go from right to left.
     *
     * @return
     *      The operand or `null` if it does not exist
     */
    public function getOperand(int $pos): ?string {
        if ($pos < 0) {
            $pos = count($this->mOperands) + $pos;

            if ($pos < 0) {
                return null;
            }
        }

        if (isset($this->mOperands[$pos])) {
            return $this->mOperands[$pos];
        }

        return null;
    }

    /**
     * Get the number of operands
     */
    public function getOperandCount(): int {
        return count($this->mOperands);
    }

    /**
     * Allow PHP to convert this to a proper string
     *
     * @internal
     * @php
     */
    public function __toString() {
        $ret = [];

        if (!empty($this->mExecPath)
                && !empty($this->mExecFile)) {

            $ret[] = str_replace(" ", "\\ ", $this->mExecPath) . "/" . str_replace(" ", "\\ ", $this->mExecFile);

        } else if (!empty($this->mExecFile)) {
            $ret[] = str_replace(" ", "\\ ", $this->mExecFile);
        }

        if (!empty($this->mFlags)) {
            foreach ($this->mFlags as $flag => $ign) {
                if (strlen($flag) > 1) {
                    $ret[] = "--$flag";

                } else {
                    $ret[] = "-$flag";
                }
            }
        }

        if (!empty($this->mOptions)) {
            foreach ($this->mOptions as $key => $val) {
                if (is_array($val)) {
                    foreach ($val as $realval) {
                        $ret[] = "--" . $key . "[] " . (strpos($realval, ' ') !== false ? "'$realval'" : "$realval");
                    }

                } else {
                    $ret[] = "--" . $key . " " . (strpos($val, ' ') !== false ? "'$val'" : "$val");
                }
            }
        }

        if (!empty($this->mOperands)) {
            $ret[] = "--";

            foreach ($this->mOperands as $opt) {
                $ret[] = $opt;
            }
        }

        return implode(" ", $ret);
    }
}
