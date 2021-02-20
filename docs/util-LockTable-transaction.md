# [Utilities](util.md) / [LockTable](util-LockTable.md) :: transaction
 > im\util\res\LockTable
____

## Description
Perform a transaction on this dataset.
You can use the `DataTable::T_` constants to define the transation.

## Synopsis
```php
public transaction(int $code, mixed $key = NULL, mixed $value = NULL): mixed
```

## Parameters
| Name | Description |
| :--- | :---------- |
| code | A transaction code. |
| key | A dataset key, if the transaction requires it. |
| value | A dataset value, if the transaction requires it. |

## Return
Returned values are defiend by the transaction. Some transactions does not
provide a return value.
