# [Utilities](util.md) / [DataTable](util-DataTable.md) :: T_ITR
 > im\util\res\DataTable
____

## Description
Get an iterator for the dataset.

 > You don't have to invoke this transaction. You can simply iterate the instance itself. This is mostly to be used when extending this class, to allow changing the iterator in a consistent maner.  

 > This transaction will return an iterator for this dataset.  

## Synopsis
```php
public int T_ITR = 0b01110000
```

## Example 1
```php
$itt = $table->transaction(DataTable::T_ITR);

if ($itt as $key => $value) {
    // ...
}
```
