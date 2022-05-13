<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use im\util\Stackable;
use im\util\FIFOStack;

final class FIFOStackTest extends TestCase {

    protected Stackable $stack;

    /**
     *
     */
    public function setUp(): void {
        $this->stack = new FIFOStack();
    }

    /**
     *
     */
    public function test_expansionMid(): void {
        $i = 0;
        while ($i++ < 100) {
            $this->stack->push("Stack $i");
        }

        $i = 0;
        while ($i++ < 10) {
            $this->assertEquals("Stack $i", $this->stack->pop());
        }

        $i = 100;
        while ($i++ < 125) {
            $this->stack->push("Stack $i");
        }

        $i = 10;
        while ($i++ < 20) {
            $this->assertEquals("Stack $i", $this->stack->pop());
        }

        foreach ($this->stack as $value) {
            $this->assertEquals("Stack $i", $value); break;
        }
    }

    /**
     *
     */
    public function test_expansionHigh(): void {
        $i = 0;
        while ($i++ < 100) {
            $this->stack->push("Stack $i");
        }

        $i = 0;
        while ($i++ < 60) {
            $this->assertEquals("Stack $i", $this->stack->pop());
        }

        $i = 100;
        while ($i++ < 200) {
            $this->stack->push("Stack $i");
        }

        $i = 60;
        while ($i++ < 70) {
            $this->assertEquals("Stack $i", $this->stack->pop());
        }

        foreach ($this->stack as $value) {
            $this->assertEquals("Stack $i", $value); break;
        }
    }
}
