# [Base](base.md) / [Utilities](util.md) / DataTable
 > im\util\res\DataTable
____

## Description
This is a light absstraction to dealing with a PHP array.

The point of this class, is to provide a way to deal with a PHP array,
while also allowing modifications in terms of extends or replace.
This allows you to add other features to something that is using this class,
by for an example, extending this class, without hardly touching whatever is using it.

To keep this simple and as light weight as possible, this class
is dumb as a nail. It does not do any sort of checking on things like
arguments and such, since this is the task of the implementer.

Also it's build on a simple transaction scheme. This makes a simple layout
and also allows adding more features, without breaking old implementations or implementers.

 > The bits in the transaction code are used as following. The last 3 bits tells `transaction` what operation is being performed.<br /><br />0b00[1] ------- Performs a change in the dataset<br /><br />0b0[1]0 ------- Performs a possible change in the dataset size (1 = add, 0 = remove). This is only read if the first bit is set.<br /><br />0b[1]00 ------- Needs to re-check the dataset length (Rather than just adding or subtracting 1). This is only read if the first bit is set.<br /><br />The 4'th bit is reserved, just in case. The remaining bits follows regular decimal scheme, starting at `1`.  

## Synopsis
```php
abstract class DataTable implements IteratorAggregate, Traversable {

    // Constants
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
    public transaction(int $code, string|int|null $key = NULL, mixed $value = NULL): mixed
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__DataTable&nbsp;::&nbsp;T\_CNT__](util-DataTable-prop_T_CNT.md) | Re-sync dataset length |
| [__DataTable&nbsp;::&nbsp;T\_GET__](util-DataTable-prop_T_GET.md) | Get a value from the dataset |
| [__DataTable&nbsp;::&nbsp;T\_SET__](util-DataTable-prop_T_SET.md) | Set a value in the dataset |
| [__DataTable&nbsp;::&nbsp;T\_CHK__](util-DataTable-prop_T_CHK.md) | Check to see if a key exists |
| [__DataTable&nbsp;::&nbsp;T\_DEL__](util-DataTable-prop_T_DEL.md) | Remove a key from the dataset |
| [__DataTable&nbsp;::&nbsp;T\_CLR__](util-DataTable-prop_T_CLR.md) | Clear the whole dataset |
| [__DataTable&nbsp;::&nbsp;T\_LEN__](util-DataTable-prop_T_LEN.md) | Get the current length of the dataset |
| [__DataTable&nbsp;::&nbsp;T\_ITR__](util-DataTable-prop_T_ITR.md) | Get an iterator for the dataset |
| [__DataTable&nbsp;::&nbsp;T\_LOC__](util-DataTable-prop_T_LOC.md) | Get the position/key of a value within the dataset |

## Methods
| Name | Description |
| :--- | :---------- |
| [__DataTable&nbsp;::&nbsp;transaction__](util-DataTable-transaction.md) | Perform a transaction on this dataset |

## Example 1
```php
$table = new DataTable();
$table->transaction(DataTable::T_SET, $key, $value);

foreach ($table as $key => $value) {
    // ...
}
```

## Example 2
Extending this class is easy.

```php
class MyTable extends DataTable {
    public function transaction(int $code, int|string $key = null, mixed $value = null): mixed {
        if ($code & 0b1) {
            throw new Exception("It's now allowed to make changes to this dataset");
        }

        return parent::transaction($code, $key, $value);
    }
}
```

The above class will prevent any changes to the dataset. It's not very useful,
but any class that is build to use `DataTable` can easily work with the modified version
without much trouble.
