# [Util](Util.md) / [LockTable](Util-LockTable.md) :: T_CNT
 > im\util\res\LockTable
____

## Description
Re-sync dataset length.

By default most transactions will trigger an internal
length variable to be changed by `1`. This code will
force the instance to sync the length of the dataset by
counting the actual values being stored.

This is mostly useful if you extend this class and perform some operation
that may require this, while allowing the original class handle it.

    This transaction does not provide a return value.  

## Synopsis
```php
const int T_CNT = 0b00000101
```
