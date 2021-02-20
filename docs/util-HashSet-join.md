# [Utilities](util.md) / [HashSet](util-HashSet.md) :: join
 > im\util\HashSet
____

## Description
Join all the values in the list into one string.

## Synopsis
```php
public join(null|string $delimiter = NULL): string
```

## Parameters
| Name | Description |
| :--- | :---------- |
| delimiter | Optional string or character that will be added in between<br />each value in the string. |

## Return
Returns the joined string.

## Example 1
```php
$ins1 = new HashSet( ["Val1", "Val2"] );
echo $ins1->join(':');
```

```
Output: Val1:Val2
```
