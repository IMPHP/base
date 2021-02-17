# [Base](Base.md) / [Util](Util.md) / Struct
 > im\util\Struct
____

## Description
An extended stdClass-like class

The major purpose with this class, is to provide a better interface
to be used as a replacement for PHP's stdClass. What that means is that
although stdClass is great when you need an object with a few properties,
it's main purpose is to be used for convertion of arrays to objects.

Struct is mosly meant to be used just like you would stdClass.
But the interface itself is a better datatype to parse between classes and methods,
because it does not signal the likelyhood of an array casting. So when it comes down to
stdClass vs Struct, it's mostly just the separation of the purpose.

Of cause that does not mean that we can't add a little extra spices to Struct
while we're add it. So what does it do that stdClass does'nt?

   1. Quick/Easy instantiation of all the keys that should be available.
   2. Quick/Easy filling of default values.
   3. Optional invoke callable can be added with access to `$this` and internal data storage.
   4. Only registered keys can be used.

The above features extends the posibilities a bit.

   1. You can use this purely as an stdClass replacement.
   2. You can use this as an stdClass replacement with a callable to do something with it's content.
   3. You can use this as a callable replacement that allows you to store internal data for the next time it's being invoked.

## Synopsis
```php
class Struct {

    // Properties
    protected $memory

    // Methods
    initialize(string $key): void
    setOnInvoke(callable $callable): static
    static factory(string $keys): static
    fill(mixed $values): static
    makeNew(mixed $values): static
}
```

## Properties
| Name | Description |
| :--- | :---------- |
| [__Struct&nbsp;::&nbsp;memory__](Util-Struct_memory.md) | A property that can be used by invoke callables to store data between calls |

## Methods
| Name | Description |
| :--- | :---------- |
| [__Struct&nbsp;::&nbsp;initialize__](Util-Struct_initialize.md) | Initialize a single key. |
| [__Struct&nbsp;::&nbsp;setOnInvoke__](Util-Struct_setOnInvoke.md) | Add a callable that will be called when trying to access this |
| [__Struct&nbsp;::&nbsp;factory__](Util-Struct_factory.md) | Create a `Struct` with multiple keys already initialized |
| [__Struct&nbsp;::&nbsp;fill__](Util-Struct_fill.md) | Fill all initialized keys with values |
| [__Struct&nbsp;::&nbsp;makeNew__](Util-Struct_makeNew.md) | Create a new instance with the same initialized keys |

## Example 1
```php
// Initialize the keys that will be available with 'NULL value'
$struct = Struct::factory("key1", "key2", "key3");

// Fill keys with real values, must come in the same order as the keys.
$struct->fill("Some text", 10, true);

// Change a single key value
$struct->key1 = "Another text";

// Create a new struct equal to the one creating it. The values are optional.
$newStruct = $struct->makeNew("New text", 25, false);

// Register an invoke callable to the new struct
$newStruct->setOnInvoke(function(){ return $this->key2; });

// Call the new struct
$key2 = $newStruct();
```
