# [Base](Base.md) / [Util](Util.md) / LockTable
 > im\util\res\LockTable
____

## Description
Extension to `DataTable` that enables immutability.

This DataTable extenstion enables immutability by adding a lock feature.
By invoking the transaction code `T_LCK`, the dataset will be locked from
performing any type of changes to the dataset. You can still lookup values and such,
but any attempts at making a change like clearing the dataset, adding or removing a value
will throw an exception.

    If a `LockTable` is cloned, the cloned version will have the dataset unlocked.  

## Synopsis
```php
class LockTable extends im\util\res\DataTable {

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
| [__LockTable&nbsp;::&nbsp;T\_LCK__](Util-LockTable_T_LCK.md) | Lock the dataset to make it immutable |
| [__LockTable&nbsp;::&nbsp;T\_CNT__](Util-LockTable_T_CNT.md) | Re-sync dataset length. |
| [__LockTable&nbsp;::&nbsp;T\_GET__](Util-LockTable_T_GET.md) | Get a value from the dataset |
| [__LockTable&nbsp;::&nbsp;T\_SET__](Util-LockTable_T_SET.md) | Set a value in the dataset |
| [__LockTable&nbsp;::&nbsp;T\_CHK__](Util-LockTable_T_CHK.md) | Check to see if a key exists |
| [__LockTable&nbsp;::&nbsp;T\_DEL__](Util-LockTable_T_DEL.md) | Remove a key from the dataset. This will not produce any errors |
| [__LockTable&nbsp;::&nbsp;T\_CLR__](Util-LockTable_T_CLR.md) | Clear the whole dataset |
| [__LockTable&nbsp;::&nbsp;T\_LEN__](Util-LockTable_T_LEN.md) | Get the current length of the dataset |
| [__LockTable&nbsp;::&nbsp;T\_ITR__](Util-LockTable_T_ITR.md) | Get an iterator for the dataset |
| [__LockTable&nbsp;::&nbsp;T\_LOC__](Util-LockTable_T_LOC.md) | Get the position/key of a value within the dataset |

## Methods
| Name | Description |
| :--- | :---------- |
| [__LockTable&nbsp;::&nbsp;transaction__](Util-LockTable_transaction.md) | Perform a transaction on this dataset. |
