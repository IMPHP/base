# [Base](base.md) / [I/O](io.md) / CompressionHeader
 > im\io\res\CompressionHeader
____

## Description
Internal helper class for `im\io\CompressionStream` implementations.

This class is meant to help implementations of `CompressionStream`
to internally deal with header information. Each implementation
can easily make use of their own properties for this task.
This simply provides something that is ready to use.

The class has several properties, each containing a `im\util\Struct` instance.
Each instance defines a portion of the SQSync header
and each instance has 3 initialized keys `offset`, `length` and `data`.

The `offset` specifies the offset of that specific portion in the header,
the `length` is of cause the `length` of that portion along with the actual
`data` that portion contains. Some default data is pre-filled, but the idea is that
the implementations can fill in the data on class construct.

## Synopsis
```php
class CompressionHeader {

    // Properties
    public im\util\Struct $bank1
    public im\util\Struct $bank2
    public im\util\Struct $bank3
    public im\util\Struct $bank4
    public im\util\Struct $bank5
    public im\util\Struct $bank6
    public int $length

    // Methods
    public __construct()
}
```

## Properties
| Name | Description |
| :--- | :---------- |
| [__CompressionHeader&nbsp;::&nbsp;$bank1__](io-CompressionHeader-var_bank1.md) | Stores the SQSync signature |
| [__CompressionHeader&nbsp;::&nbsp;$bank2__](io-CompressionHeader-var_bank2.md) | Stores the algorithm signature |
| [__CompressionHeader&nbsp;::&nbsp;$bank3__](io-CompressionHeader-var_bank3.md) | Stores the algorithm reserved space |
| [__CompressionHeader&nbsp;::&nbsp;$bank4__](io-CompressionHeader-var_bank4.md) | Stores the uncompressed content data length |
| [__CompressionHeader&nbsp;::&nbsp;$bank5__](io-CompressionHeader-var_bank5.md) | Stores the length of the additional header space |
| [__CompressionHeader&nbsp;::&nbsp;$bank6__](io-CompressionHeader-var_bank6.md) | Stores the additional header |
| [__CompressionHeader&nbsp;::&nbsp;$length__](io-CompressionHeader-var_length.md) | Readonly property that returns the total length of the header |

## Methods
| Name | Description |
| :--- | :---------- |
| [__CompressionHeader&nbsp;::&nbsp;\_\_construct__](io-CompressionHeader-__construct.md) |  |
