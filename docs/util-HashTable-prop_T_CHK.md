# [Utilities](util.md) / [HashTable](util-HashTable.md) :: T_CHK
 > im\util\res\HashTable
____

## Description
Check to see if a key exists.

 > This transaction will return `TRUE` if the key exists or `FALSE` otherwise.  

## Synopsis
```php
public int T_CHK = 0b00110000
```

## Example 1
```php
if ($table->transaction(DataTable::T_CHK, $key)) {
    // ...
}
```
