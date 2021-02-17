# [Util](Util.md) / [LockTable](Util-LockTable.md) :: T_CLR
 > im\util\res\LockTable
____

## Description
Clear the whole dataset

    This transaction does not provide a return value.  

## Synopsis
```php
const int T_CLR = 0b01010101
```

## Example 1
```php
$table->transaction(DataTable::T_CLR);
```
