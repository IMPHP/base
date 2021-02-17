<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use im\util\IndexArray;
use im\util\Vector;

final class VectorTest extends TestCase {

    protected IndexArray $List;

    /**
     *
     */
    public function setUp(): void {
        $this->List = new Vector();
    }


    /* ---------------------------------------
     *  ListArray
     */

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

    /* ---------------------------------------
     *  IndexArray
     */

     /**
      *
      */
     public function test_indexOf(): void {
         $this->assertEquals(
             -1,
             $this->List->indexOf("MyValue")
         );

         $this->List->add("MyValue");
         $this->assertEquals(
             0,
             $this->List->indexOf("MyValue")
         );
     }

     /**
      *
      */
     public function test_get(): void {
         $this->List->set(0, "MyValue");
         $this->assertEquals(
             "MyValue",
             $this->List->get(-1)
         );
     }

     /**
      *
      */
     public function test_insert(): void {
         $this->List->insert(-1, "MyValue1");
         $this->assertEquals(
             "MyValue1",
             $this->List->get(0)
         );

         $this->List->add("MyValue2");
         $this->List->add("MyValue3");
         $this->List->add("MyValue4");

         $this->List->insert(2, "MyValue5");
         $this->assertEquals(
             "MyValue5",
             $this->List->get(2)
         );

         $this->assertEquals(
             "MyValue3",
             $this->List->get(3)
         );
     }

     /**
      *
      */
     public function test_unset(): void {
         $this->List->add("MyValue");
          $this->List->add("MyOtherValue");

         $this->assertEquals(
             true,
             $this->List->contains("MyValue")
         );

         $value = $this->List->unset(0);

         $this->assertEquals(
             false,
             $this->List->contains("MyValue")
         );

         $this->assertEquals(
             true,
             $this->List->contains("MyOtherValue")
         );

         $this->assertEquals(
             0,
             $this->List->indexOf("MyOtherValue")
         );
     }
}
