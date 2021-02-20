# [Utilities](util.md) / [BaseCollection](util-BaseCollection.md) :: combineArrays
 > im\util\BaseCollection
____

## Description
Combine two arrays recursively

This is similar to `array_merge_recursive()`, but this method
does not alter the structure. For example if you combine an array with
the same key containing a string, you do not get an indexed array containing
two strings. The second string will replace the first one. Indexed arrays
however are merged normally.

## Synopsis
```php
public static combineArrays(array &$array1, array &$array2): array
```

## Parameters
| Name | Description |
| :--- | :---------- |
| array1 | First array which will have second priority |
| array2 | Second array which will have first priority |

## Return
A new array containing the merged data
