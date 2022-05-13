# [Utilities](util.md) / [StringBuilder](util-StringBuilder.md) :: substrpos
 > im\util\StringBuilder
____

## Description
A combination of `substr` and `strpos`.

This method combines `strpos` to be used for `substr`.
Both `offset` and `length` can be defined by an `integer` or by a
`string` that will extract the position using `strpos`.

## Synopsis
```php
public substrpos(string|int $offset, string|int|null $length = NULL, bool $ci = FALSE, int $mode = im\util\StringBuilder::MODE_LEFT): null|static
```

## Parameters
| Name | Description |
| :--- | :---------- |
| offset | The start position. |
| length | Length beginning from offset. |
| ci | Whether to use case-insensitive search (Only applies on non-integer offset or length) |
| mode | Whether to search left-to-right or right-to-left. |

## Return
May return `null` if `strpos` fails

## Example 1
```php
// The new string will start from '0' and stop at the first '\n'
$new = $builder->substrpos(0, "\n");
```
