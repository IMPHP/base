# [Base](base.md) / [Utilities](util.md) / HashTable
 > im\util\res\HashTable
____

## Description
Extension to `DataTable` that allows using multiple data types as key.

This DataTable extenstion enables key hashing, allowing the usage of
other data types as keys. Normally only `string` and `int` is allowed.

## Synopsis
```php
abstract class HashTable extends im\util\res\LockTable implements IteratorAggregate, Traversable {

    // Inherited Constants
    public int T_LCK = 0b00001000
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
| [__HashTable&nbsp;::&nbsp;T\_LCK__](util-HashTable-prop_T_LCK.md) | Lock the dataset to make it immutable |
| [__HashTable&nbsp;::&nbsp;T\_CNT__](util-HashTable-prop_T_CNT.md) | Re-sync dataset length |
| [__HashTable&nbsp;::&nbsp;T\_GET__](util-HashTable-prop_T_GET.md) | Get a value from the dataset |
| [__HashTable&nbsp;::&nbsp;T\_SET__](util-HashTable-prop_T_SET.md) | Set a value in the dataset |
| [__HashTable&nbsp;::&nbsp;T\_CHK__](util-HashTable-prop_T_CHK.md) | Check to see if a key exists |
| [__HashTable&nbsp;::&nbsp;T\_DEL__](util-HashTable-prop_T_DEL.md) | Remove a key from the dataset |
| [__HashTable&nbsp;::&nbsp;T\_CLR__](util-HashTable-prop_T_CLR.md) | Clear the whole dataset |
| [__HashTable&nbsp;::&nbsp;T\_LEN__](util-HashTable-prop_T_LEN.md) | Get the current length of the dataset |
| [__HashTable&nbsp;::&nbsp;T\_ITR__](util-HashTable-prop_T_ITR.md) | Get an iterator for the dataset |
| [__HashTable&nbsp;::&nbsp;T\_LOC__](util-HashTable-prop_T_LOC.md) | Get the position/key of a value within the dataset |

## Methods
| Name | Description |
| :--- | :---------- |
| [__HashTable&nbsp;::&nbsp;transaction__](util-HashTable-transaction.md) | Perform a transaction on this dataset |
