<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use im\util\ListArray;
use im\util\Set;

final class SetTest extends TestCase {

    protected ListArray $List;

    /**
     *
     */
    public function setUp(): void {
        $this->List = new Set();
    }

    /**
     *
     */
    public function test_add(): void {
        $this->List->add("MyValue");

        foreach ($this->List as $value) {
            $this->assertEquals("MyValue", $value);
        }
    }

    /**
     *
     */
    public function test_addIterable(): void {
        $itt = (function(){
            yield "MyValue";
        })();

        $this->List->addIterable($itt);

        foreach ($this->List as $value) {
            $this->assertEquals("MyValue", $value);
        }
    }

    /**
     *
     */
    public function test_contains(): void {
        $this->List->add("MyValue");

        $this->assertEquals(
            true,
            $this->List->contains("MyValue")
        );

        $this->assertEquals(
            false,
            $this->List->contains("MyOtherValue")
        );
    }

    /**
     *
     */
    public function test_remove(): void {
        $this->List->add("MyValue");

        $this->assertEquals(
            true,
            $this->List->contains("MyValue")
        );

        $this->List->remove("MyValue");

        $this->assertEquals(
            false,
            $this->List->contains("MyValue")
        );
    }

    /**
     *
     */
    public function test_join(): void {
        $this->List->add("MyValue");
        $this->List->add("MyOtherValue");

        $this->assertEquals(
            "MyValue, MyOtherValue",
            $this->List->join(", ")
        );
    }

    /**
     *
     */
    public function test_length(): void {
        $this->assertEquals(0, $this->List->length());

        $this->List->add("MyValue");
        $this->assertEquals(1, $this->List->length());

        $this->List->add("MyOtherValue");
        $this->assertEquals(2, $this->List->length());
    }

    /**
     *
     */
    public function test_toArray(): void {
        $this->List->add("MyValue");
        $this->List->add("MyOtherValue");

        $this->assertEquals(
            ["MyValue", "MyOtherValue"], 
            $this->List->toArray()
        );
    }
}
