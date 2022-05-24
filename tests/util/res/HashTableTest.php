<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use im\util\res\DataTable;
use im\util\res\HashTable;

/**
 * @deprecated
 *
 * This test points to a deprecated class `im\util\res\HashTable`
 */
final class HashTableTest extends TestCase {

    protected DataTable $Table;

    /**
     *
     */
    public function setUp(): void {
        $this->Table = new class() extends HashTable {};
    }

    /**
     *
     */
    public function testCodeSET(): void {
        $this->Table->transaction(DataTable::T_SET, "MyKey", "MyValue");
        $this->assertEquals(
            "MyValue",
            $this->Table->transaction(DataTable::T_GET, "MyKey")
        );
    }

    /**
     *
     */
    public function testCodeCHK(): void {
        $this->Table->transaction(DataTable::T_SET, "MyKey", "MyValue");
        $this->assertEquals(
            true,
            $this->Table->transaction(DataTable::T_CHK, "MyKey")
        );
        $this->assertEquals(
            false,
            $this->Table->transaction(DataTable::T_CHK, "MyOtherKey")
        );
    }

    /**
     *
     */
    public function testCodeDEL(): void {
        $this->Table->transaction(DataTable::T_SET, "MyKey", "MyValue");
        $this->Table->transaction(DataTable::T_DEL, "MyKey");
        $this->assertEquals(
            null,
            $this->Table->transaction(DataTable::T_GET, "MyKey")
        );
    }

    /**
     *
     */
    public function testCodeLEN(): void {
        for ($i=0, $x=1; $i < 12; $i++) {
            if ($i > 0 && ($i % 3) == 0) {
                $this->Table->transaction(DataTable::T_DEL, "MyKey$x");
                $this->assertEquals(
                    --$x,
                    $this->Table->transaction(DataTable::T_LEN)
                );

            } else {
                $this->Table->transaction(DataTable::T_SET, "MyKey$x", "MyValue$x");
                $this->assertEquals(
                    $x++,
                    $this->Table->transaction(DataTable::T_LEN)
                );
            }
        }
    }

    /**
     *
     */
    public function testCodeCLR(): void {
        $this->Table->transaction(DataTable::T_SET, "MyKey", "MyValue");
        $this->assertEquals(
            1,
            $this->Table->transaction(DataTable::T_LEN)
        );

        $this->Table->transaction(DataTable::T_CLR);
        $this->assertEquals(
            0,
            $this->Table->transaction(DataTable::T_LEN)
        );
    }

    /**
     *
     */
    public function testCodeLOC(): void {
        $this->Table->transaction(DataTable::T_SET, "MyKey", "MyValue");
        $this->assertEquals(
            "MyKey",
            $this->Table->transaction(DataTable::T_LOC, null, "MyValue")
        );
    }

    /**
     *
     */
    public function testCodeLCK(): void {
        $this->Table->transaction(HashTable::T_LCK);
        $this->expectException(Exception::class);
        $this->Table->transaction(DataTable::T_CLR);
    }

    /**
     *
     */
    public function testCodeITR(): void {
        $this->Table->transaction(DataTable::T_SET, "MyKey", "MyValue");

        foreach ($this->Table as $key => $value) {
            $this->assertEquals("MyKey", $key);
            $this->assertEquals("MyValue", $value);
        }
    }
}
