# [Base](base.md) / [Features](features.md) / Wrapper
 > im\features\Wrapper
____

## Description
Define a wrapper object

This is a very generic interface that simply defines a class
that acts as a wrapper on top of another object. It should always
be used in conjuntion with another interface to better specify the type.

## Synopsis
```php
interface Wrapper {

    // Methods
    unwrap(): null|object
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__Wrapper&nbsp;::&nbsp;unwrap__](features-Wrapper-unwrap.md) | Return the original object within the wrapper object |
