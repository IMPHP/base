# [Utilities](util.md) / [HashTable](util-HashTable.md) :: T_SET
 > im\util\res\HashTable
____

## Description
Set a value in the dataset.

 > This transaction does not provide a return value.  

## Synopsis
```php
public int T_SET = 0b00100011
```

## Example 1
```php
$table->transaction(DataTable::T_SET, $key, $value);
```
