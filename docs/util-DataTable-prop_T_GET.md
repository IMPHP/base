# [Utilities](util.md) / [DataTable](util-DataTable.md) :: T_GET
 > im\util\res\DataTable
____

## Description
Get a value from the dataset.

 > This transaction will return the value being requested or `NULL` if the defined key does not exist.  

## Synopsis
```php
public int T_GET = 0b00010000
```

## Example 1
```php
$value = $table->transaction(DataTable::T_GET, $key);
```
