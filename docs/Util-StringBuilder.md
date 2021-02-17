# [Base](Base.md) / [Util](Util.md) / StringBuilder
 > im\util\StringBuilder
____

## Description
An implementation of the `StringableBuilder` interface with additional features.

## Synopsis
```php
class StringBuilder implements im\util\StringableBuilder {

    // Methods
    append(string|Stringable $texts): void
    appendFormat(string $format, mixed $texts): void
    prepend(string|Stringable $texts): void
    prependFormat(string $format, mixed $texts): void
    beginsWith(string|Stringable $text, bool $ci = false): bool
    endsWith(string|Stringable $text, bool $ci = false): bool
    contains(string|Stringable $text, bool $ci = false): bool
    equal(string|Stringable $text, bool $ci = false): bool
    clear(): void
    length(): int
    toString(): string
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__StringBuilder&nbsp;::&nbsp;append__](Util-StringBuilder_append.md) | Append strings to the end of the current string |
| [__StringBuilder&nbsp;::&nbsp;appendFormat__](Util-StringBuilder_appendFormat.md) | Append a formated string to the end of the current string. |
| [__StringBuilder&nbsp;::&nbsp;prepend__](Util-StringBuilder_prepend.md) | Prepend strings to the beginning of the current string |
| [__StringBuilder&nbsp;::&nbsp;prependFormat__](Util-StringBuilder_prependFormat.md) | Prepend a formated string to the beginning of the current string. |
| [__StringBuilder&nbsp;::&nbsp;beginsWith__](Util-StringBuilder_beginsWith.md) | Check to see if this string begins with a specified substring |
| [__StringBuilder&nbsp;::&nbsp;endsWith__](Util-StringBuilder_endsWith.md) | Check to see if this string ends with a specified substring |
| [__StringBuilder&nbsp;::&nbsp;contains__](Util-StringBuilder_contains.md) | Check to see if this string contains a specified substring |
| [__StringBuilder&nbsp;::&nbsp;equal__](Util-StringBuilder_equal.md) | Check to see if this string is equal to a specified string |
| [__StringBuilder&nbsp;::&nbsp;clear__](Util-StringBuilder_clear.md) | Clear this StringBuilder |
| [__StringBuilder&nbsp;::&nbsp;length__](Util-StringBuilder_length.md) | Get the current length of this StringBuilder |
| [__StringBuilder&nbsp;::&nbsp;toString__](Util-StringBuilder_toString.md) | Return a PHP `string` of this StringBuilder |

## Example 1
```php
$str = new StringBuilder();
$str->appendFormat(" - %s = [%s]\\n", $var1, $var2);
$str->append($var3, "\\n");
$str->append($var5, "\\n");

echo $str->toString();
```
