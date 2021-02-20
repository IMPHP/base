# [Utilities](util.md) / [LockTable](util-LockTable.md) :: T_CLR
 > im\util\res\LockTable
____

## Description
Clear the whole dataset

 > This transaction does not provide a return value.  

## Synopsis
```php
public int T_CLR = 0b01010101
```

## Example 1
```php
$table->transaction(DataTable::T_CLR);
```
