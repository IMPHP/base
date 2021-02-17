# [Util](Util.md) / [Struct](Util-Struct.md) :: memory
 > im\util\Struct
____

## Description
A property that can be used by invoke callables to store data between calls

The Struct is not to be confused with an easy way to create
class objects. It's a simple storage class to optain multiple values
much like a map, but more object-like. It has an invoke feature allowing
a single callable to be invoked on the object, and some times this callable may
want to store a little bit of data, which a single property should be able to do
just fine. It can always be assigned as a Struct itself, stdClass or array for multiple
key/value pairs.

## Synopsis
```php
protected $memory
```
