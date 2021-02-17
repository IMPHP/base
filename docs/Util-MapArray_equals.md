# [Util](Util.md) / [MapArray](Util-MapArray.md) :: equals
 > im\util\MapArray
____

## Description
Compare an object against this instance.
This will match both the type and the content.

## Synopsis
```php
equals(object $other): bool
```

## Parameters
| Name | Description |
| :--- | :---------- |
| other | An object to compare against this collection instance. |

## Return
Returns `true` if both are equal type and has the same content
or `false` if type or content does not match.

## Example 1
```php
$ins1 = new HashSet( ["Val1", "Val2"] );
$ins2 = new Vector( ["Val1", "Val2"] );
$ins3 = new Set( ["Val1", "Val2", "Val3"] );

$ins1->equals($ins2); // Returns true
$ins2->equals($ins1); // Returns false
$ins3->equals($ins1); // Returns false
```

The first returns `true` because a HashSet will compare it to `ListArray`
which both instances are a part of. The second will return `false`
because a Vector will compare it to `IndexList` which only Vector is a part of.
The third will return `false` because the two have different values.
