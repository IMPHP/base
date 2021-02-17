# [Util](Util.md) / [DataTable](Util-DataTable.md) :: T_DEL
 > im\util\res\DataTable
____

## Description
Remove a key from the dataset. This will not produce any errors
if the key does not exist.

    This transaction does not provide a return value.  

## Synopsis
```php
const int T_DEL = 0b01000001
```

## Example 1
```php
$table->transaction(DataTable::T_DEL, $key);
```
