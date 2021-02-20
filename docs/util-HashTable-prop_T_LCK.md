# [Utilities](util.md) / [HashTable](util-HashTable.md) :: T_LCK
 > im\util\res\HashTable
____

## Description
Lock the dataset to make it immutable.

 > Cloned versions of this instance will have their dataset unlocked.  

## Synopsis
```php
public int T_LCK = 0b00001000
```

## Example 1
```php
$table->transaction(DataTable::T_LCK, $key);

// Throws exception
$table->transaction(DataTable::T_SET, $key, $value);
```
