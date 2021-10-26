# [Base](base.md) / [Utilities](util.md) / PropertyAccess
 > im\util\res\PropertyAccess
____

## Description
Small trait to access get/set methods via property access.

After including this trait to a class,
any `getName()` and `get_name()` method will act as a getter
for property access via `$this->name`.

Likewise any `setName($var)` and `set_name($var)` will act as
a setter via `$this->name = $var`.

## Synopsis
```php
trait PropertyAccess {
}
```
