# [Util](Util.md) / [LockTable](Util-LockTable.md) :: T_LCK
 > im\util\res\LockTable
____

## Description
Lock the dataset to make it immutable.

    Cloned versions of this instance will have their dataset unlocked.  

## Synopsis
```php
const int T_LCK = 0b00001000
```

## Example 1
```php
$table->transaction(DataTable::T_LCK, $key);

// Throws exception
$table->transaction(DataTable::T_SET, $key, $value);
```
