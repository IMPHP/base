# [Base](base.md) / [Features](features.md) / Cloneable
 > im\features\Cloneable
____

## Description
An interface that ensures that an object is made to be cloned properly

PHP does allow any object to be cloned using `clone $object`, however
the object itself may not be suitable for clone, if it does not internally
mend any problems associated with cloning it.

This interface defines objects that are built to deal with being cloned.

## Synopsis
```php
interface Cloneable {

    // Methods
    clone(): static
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__Cloneable&nbsp;::&nbsp;clone__](features-Cloneable-clone.md) | A proper OOP cloning method  Classes implementing this interface should also be able to deal with `clone $object` |
