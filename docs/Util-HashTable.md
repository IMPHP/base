# [Base](Base.md) / [Util](Util.md) / HashTable
 > im\util\res\HashTable
____

## Description
Extension to `DataTable` that allows using multiple data types as key.

This DataTable extenstion enables key hashing, allowing the usage of
other data types as keys. Normally only `string` and `int` is allowed. 

## Synopsis
```php
class HashTable extends im\util\res\LockTable {

    // Constants
    const int T_LCK = 0b00001000
    const int T_CNT = 0b00000101
    const int T_GET = 0b00010000
    const int T_SET = 0b00100011
    const int T_CHK = 0b00110000
    const int T_DEL = 0b01000001
    const int T_CLR = 0b01010101
    const int T_LEN = 0b01100000
    const int T_ITR = 0b01110000
    const int T_LOC = 0b10000000

    // Methods
    transaction(int $code, mixed $key = null, mixed $value = null): mixed
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__HashTable&nbsp;::&nbsp;T\_LCK__](Util-HashTable_T_LCK.md) | Lock the dataset to make it immutable |
| [__HashTable&nbsp;::&nbsp;T\_CNT__](Util-HashTable_T_CNT.md) | Re-sync dataset length. |
| [__HashTable&nbsp;::&nbsp;T\_GET__](Util-HashTable_T_GET.md) | Get a value from the dataset |
| [__HashTable&nbsp;::&nbsp;T\_SET__](Util-HashTable_T_SET.md) | Set a value in the dataset |
| [__HashTable&nbsp;::&nbsp;T\_CHK__](Util-HashTable_T_CHK.md) | Check to see if a key exists |
| [__HashTable&nbsp;::&nbsp;T\_DEL__](Util-HashTable_T_DEL.md) | Remove a key from the dataset. This will not produce any errors |
| [__HashTable&nbsp;::&nbsp;T\_CLR__](Util-HashTable_T_CLR.md) | Clear the whole dataset |
| [__HashTable&nbsp;::&nbsp;T\_LEN__](Util-HashTable_T_LEN.md) | Get the current length of the dataset |
| [__HashTable&nbsp;::&nbsp;T\_ITR__](Util-HashTable_T_ITR.md) | Get an iterator for the dataset |
| [__HashTable&nbsp;::&nbsp;T\_LOC__](Util-HashTable_T_LOC.md) | Get the position/key of a value within the dataset |

## Methods
| Name | Description |
| :--- | :---------- |
| [__HashTable&nbsp;::&nbsp;transaction__](Util-HashTable_transaction.md) | Perform a transaction on this dataset. |
