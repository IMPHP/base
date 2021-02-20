# [Utilities](util.md) / [LockTable](util-LockTable.md) :: T_LEN
 > im\util\res\LockTable
____

## Description
Get the current length of the dataset

 > This transaction will return the number of keys/values that is being stored.  

## Synopsis
```php
public int T_LEN = 0b01100000
```

## Example 1
```php
if ($table->transaction(DataTable::T_LEN) > 0) {
    // ...
}
```
