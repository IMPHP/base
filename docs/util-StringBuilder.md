# [Base](base.md) / [Utilities](util.md) / StringBuilder
 > im\util\StringBuilder
____

## Description
An implementation of the `StringableBuilder` interface with additional features.

## Synopsis
```php
class StringBuilder implements im\util\StringableBuilder, Stringable {

    // Methods
    public append(Stringable|string ...$texts): void
    public appendFormat(string $format, mixed ...$texts): void
    public prepend(Stringable|string ...$texts): void
    public prependFormat(string $format, mixed ...$texts): void
    public beginsWith(Stringable|string $text, bool $ci = FALSE): bool
    public endsWith(Stringable|string $text, bool $ci = FALSE): bool
    public contains(Stringable|string $text, bool $ci = FALSE): bool
    public equal(Stringable|string $text, bool $ci = FALSE): bool
    public clear(): void
    public length(): int
    public toString(): string
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__StringBuilder&nbsp;::&nbsp;append__](util-StringBuilder-append.md) | Append strings to the end of the current string |
| [__StringBuilder&nbsp;::&nbsp;appendFormat__](util-StringBuilder-appendFormat.md) | Append a formated string to the end of the current string |
| [__StringBuilder&nbsp;::&nbsp;prepend__](util-StringBuilder-prepend.md) | Prepend strings to the beginning of the current string |
| [__StringBuilder&nbsp;::&nbsp;prependFormat__](util-StringBuilder-prependFormat.md) | Prepend a formated string to the beginning of the current string |
| [__StringBuilder&nbsp;::&nbsp;beginsWith__](util-StringBuilder-beginsWith.md) | Check to see if this string begins with a specified substring |
| [__StringBuilder&nbsp;::&nbsp;endsWith__](util-StringBuilder-endsWith.md) | Check to see if this string ends with a specified substring |
| [__StringBuilder&nbsp;::&nbsp;contains__](util-StringBuilder-contains.md) | Check to see if this string contains a specified substring |
| [__StringBuilder&nbsp;::&nbsp;equal__](util-StringBuilder-equal.md) | Check to see if this string is equal to a specified string |
| [__StringBuilder&nbsp;::&nbsp;clear__](util-StringBuilder-clear.md) | Clear this StringBuilder |
| [__StringBuilder&nbsp;::&nbsp;length__](util-StringBuilder-length.md) | Get the current length of this StringBuilder |
| [__StringBuilder&nbsp;::&nbsp;toString__](util-StringBuilder-toString.md) | Return a PHP `string` of this StringBuilder |

## Example 1
```php
$str = new StringBuilder();
$str->appendFormat(" - %s = [%s]\\n", $var1, $var2);
$str->append($var3, "\\n");
$str->append($var5, "\\n");

echo $str->toString();
```
