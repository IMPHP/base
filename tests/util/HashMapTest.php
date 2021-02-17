<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use im\util\MapArray;
use im\util\HashMap;

final class HashMapTest extends TestCase {

    protected MapArray $Map;

    /**
     *
     */
    public function setUp(): void {
        $this->Map = new HashMap();
    }

    /**
     *
     */
    public function test_get(): void {
        $this->Map->set("MyKey", "MyValue");
        $this->assertEquals(
            "MyValue",
            $this->Map->get("MyKey")
        );
    }

    /**
     *
     */
    public function test_addIterable(): void {
        $itt = (function(){
            yield "MyKey" => "MyValue";
        })();

        $this->Map->addIterable($itt);

        foreach ($this->Map as $Key => $value) {
            $this->assertEquals("MyKey", $Key);
            $this->assertEquals("MyValue", $value);
        }
    }

    /**
     *
     */
    public function test_length(): void {
        $this->assertEquals(0, $this->Map->length());

        $this->Map->set("MyKey", "MyValue");
        $this->assertEquals(1, $this->Map->length());

        $this->Map->set("MyOtherKey", "MyOtherValue");
        $this->assertEquals(2, $this->Map->length());
    }

    /**
     *
     */
    public function test_contains(): void {
        $this->Map->set("MyKey", "MyValue");

        $this->assertEquals(
            true,
            $this->Map->contains("MyValue")
        );

        $this->assertEquals(
            false,
            $this->Map->contains("MyOtherValue")
        );
    }

    /**
     *
     */
    public function test_isset(): void {
        $this->Map->set("MyKey", "MyValue");

        $this->assertEquals(
            true,
            $this->Map->isset("MyKey")
        );

        $this->assertEquals(
            false,
            $this->Map->isset("MyOtherKey")
        );
    }

    /**
     *
     */
    public function test_unset(): void {
        $this->Map->set("MyKey", "MyValue");

        $this->assertEquals(
            true,
            $this->Map->isset("MyKey")
        );

        $value = $this->Map->unset("MyKey");

        $this->assertEquals(
            false,
            $this->Map->isset("MyKey")
        );

        $this->assertEquals("MyValue", $value);
    }

    /**
     *
     */
    public function test_remove(): void {
        $this->Map->set("MyKey", "MyValue");

        $this->assertEquals(
            true,
            $this->Map->contains("MyValue")
        );

        $this->Map->remove("MyValue");

        $this->assertEquals(
            false,
            $this->Map->contains("MyValue")
        );
    }

    /**
     *
     */
    public function test_find(): void {
        $this->Map->set("MyKey", "MyValue");

        $this->assertEquals(
            "MyKey",
            $this->Map->find("MyValue")
        );
    }
}
