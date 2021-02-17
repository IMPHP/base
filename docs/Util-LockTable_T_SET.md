# [Util](Util.md) / [LockTable](Util-LockTable.md) :: T_SET
 > im\util\res\LockTable
____

## Description
Set a value in the dataset.

    This transaction does not provide a return value.  

## Synopsis
```php
const int T_SET = 0b00100011
```

## Example 1
```php
$table->transaction(DataTable::T_SET, $key, $value);
```
