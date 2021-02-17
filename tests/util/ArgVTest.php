<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use im\util\ArgV;

final class ArgVTest extends TestCase {

    protected ArgV $Argv;

    /**
     *
     */
    public function __construct() {
        parent::__construct();

        $argv = [
            "/path/to/executable",
            "--help",
            "someaction",
            "-ft",
            "-u",
            "arg[]=somevalue1",
            "--arg[]",
            "somevalue2",
            "--",
            "isolated",
            "--with",
            "args",
            "-x"
        ];

        $this->Argv = new ArgV($argv, ["help"]);
    }


    /* ---------------------------------------
     *  ListArray
     */

    /**
     *
     */
    public function test_getScriptName(): void {
        $this->assertEquals(
            "executable",
            $this->Argv->getScriptName()
        );
    }

    /**
     *
     */
    public function test_getScriptPath(): void {
        $this->assertEquals(
            "/path/to",
            $this->Argv->getScriptPath()
        );
    }

    /**
     *
     */
    public function test_getFlags(): void {
        $this->assertEquals(
            ["help", 'f', 't', 'u'],
            $this->Argv->getFlags()->toArray()
        );
    }

    /**
     *
     */
    public function test_hasFlag(): void {
        $this->assertEquals(
            true,
            $this->Argv->hasFlag('t')
        );
    }

    /**
     *
     */
    public function test_hasOption(): void {
        $this->assertEquals(
            true,
            $this->Argv->hasOption("arg")
        );
    }

    /**
     *
     */
    public function test_getOption(): void {
        $this->assertEquals(
            "somevalue1",
            $this->Argv->getOption("arg")
        );
    }

    /**
     *
     */
    public function test_getOptionAsList(): void {
        $this->assertEquals(
            ["somevalue1", "somevalue2"],
            $this->Argv->getOptionAsList("arg")->toArray()
        );
    }

    /**
     *
     */
    public function test_getOperand(): void {
        $this->assertEquals(
            "someaction",
            $this->Argv->getOperand(0)
        );

        $this->assertEquals(
            "-x",
            $this->Argv->getOperand(-1)
        );
    }

    /**
     *
     */
    public function test_toString(): void {
        $this->assertEquals(
            "/path/to/executable --help -f -t -u --arg[] somevalue1 --arg[] somevalue2 -- someaction isolated --with args -x",
            strval($this->Argv)
        );
    }
}
