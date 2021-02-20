# [Base](base.md) / [Utilities](util.md) / LockTable
 > im\util\res\LockTable
____

## Description
Extension to `DataTable` that enables immutability.

This DataTable extenstion enables immutability by adding a lock feature.
By invoking the transaction code `T_LCK`, the dataset will be locked from
performing any type of changes to the dataset. You can still lookup values and such,
but any attempts at making a change like clearing the dataset, adding or removing a value
will throw an exception.

 > If a `LockTable` is cloned, the cloned version will have the dataset unlocked.  

## Synopsis
```php
abstract class LockTable extends im\util\res\DataTable implements Traversable, IteratorAggregate {

    // Constants
    public int T_LCK = 0b00001000

    // Inherited Constants
    public int T_CNT = 0b00000101
    public int T_GET = 0b00010000
    public int T_SET = 0b00100011
    public int T_CHK = 0b00110000
    public int T_DEL = 0b01000001
    public int T_CLR = 0b01010101
    public int T_LEN = 0b01100000
    public int T_ITR = 0b01110000
    public int T_LOC = 0b10000000

    // Methods
    public transaction(int $code, mixed $key = NULL, mixed $value = NULL): mixed
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__LockTable&nbsp;::&nbsp;T\_LCK__](util-LockTable-prop_T_LCK.md) | Lock the dataset to make it immutable |
| [__LockTable&nbsp;::&nbsp;T\_CNT__](util-LockTable-prop_T_CNT.md) | Re-sync dataset length |
| [__LockTable&nbsp;::&nbsp;T\_GET__](util-LockTable-prop_T_GET.md) | Get a value from the dataset |
| [__LockTable&nbsp;::&nbsp;T\_SET__](util-LockTable-prop_T_SET.md) | Set a value in the dataset |
| [__LockTable&nbsp;::&nbsp;T\_CHK__](util-LockTable-prop_T_CHK.md) | Check to see if a key exists |
| [__LockTable&nbsp;::&nbsp;T\_DEL__](util-LockTable-prop_T_DEL.md) | Remove a key from the dataset |
| [__LockTable&nbsp;::&nbsp;T\_CLR__](util-LockTable-prop_T_CLR.md) | Clear the whole dataset |
| [__LockTable&nbsp;::&nbsp;T\_LEN__](util-LockTable-prop_T_LEN.md) | Get the current length of the dataset |
| [__LockTable&nbsp;::&nbsp;T\_ITR__](util-LockTable-prop_T_ITR.md) | Get an iterator for the dataset |
| [__LockTable&nbsp;::&nbsp;T\_LOC__](util-LockTable-prop_T_LOC.md) | Get the position/key of a value within the dataset |

## Methods
| Name | Description |
| :--- | :---------- |
| [__LockTable&nbsp;::&nbsp;transaction__](util-LockTable-transaction.md) | Perform a transaction on this dataset |
