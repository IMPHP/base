# [Utilities](util.md) / [LockTable](util-LockTable.md) :: T_RPL
 > im\util\res\LockTable
____

## Description
Replace a value in the dataset.

 > This transaction will return the current value, if any.  

## Synopsis
```php
public int T_RPL = 0b00010011
```

## Example 1
```php
$oldValue = $table->transaction(DataTable::T_RPL, $key, $newValue);
```
