<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use im\util\StringBuilder;

final class StringBuilderTest extends TestCase {

    /**
     *
     */
    public function test_append(): void {
        $builder = new StringBuilder();
        $builder->append("#");
        $builder->append("Test", "1");
        $this->assertEquals(
            "#Test1",
            strval($builder)
        );

        $builder->prepend("#", "Test", "2:");
        $this->assertEquals(
            "#Test2:#Test1",
            strval($builder)
        );

        $builder->appendFormat(":#%s%d", "Test", 3);
        $this->assertEquals(
            "#Test2:#Test1:#Test3",
            strval($builder)
        );

        $builder->prependFormat("#%s%d:", "Test", 4);
        $this->assertEquals(
            "#Test4:#Test2:#Test1:#Test3",
            strval($builder)
        );
    }

    /**
     *
     */
    public function test_clear(): void {
        $builder = new StringBuilder();
        $builder->append("123456789");
        $this->assertEquals(
            9,
            $builder->length()
        );

        $builder->clear();
        $this->assertEquals(
            0,
            $builder->length()
        );
    }

    /**
     *
     */
    public function test_toString(): void {
        $builder = new StringBuilder();
        $builder->append("123456789");

        $this->assertEquals(
            "123456789",
            strval($builder)
        );

        $this->assertEquals(
            $builder->toString(),
            strval($builder)
        );
    }
}
