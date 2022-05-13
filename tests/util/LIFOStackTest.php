<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use im\util\Stackable;
use im\util\LIFOStack;

final class LIFOStackTest extends TestCase {

    protected Stackable $stack;

    /**
     *
     */
    public function setUp(): void {
        $this->stack = new LIFOStack();
    }

    /**
     *
     */
    public function test_expansionMid(): void {
        $i = 0;
        while ($i++ < 100) {
            $this->stack->push("Stack $i");
        }

        $i = 100;
        while (90 < $i) {
            $this->assertEquals("Stack ".($i--), $this->stack->pop());
        }
    }
}
