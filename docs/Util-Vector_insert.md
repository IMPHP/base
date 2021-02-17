# [Util](Util.md) / [Vector](Util-Vector.md) :: insert
 > im\util\Vector
____

## Description
Insert a value into a positional key

Unlike `set()` this will not override the existing
value. Instead it will move the data in that position and in front of it,
and add the value in between.

## Synopsis
```php
insert(int $key, mixed $value): void
```

## Parameters
| Name | Description |
| :--- | :---------- |
| key | The key to insert into. |
| value | The value to insert.  |
