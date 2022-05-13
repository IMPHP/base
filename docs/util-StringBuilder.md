# [Base](base.md) / [Utilities](util.md) / StringBuilder
 > im\util\StringBuilder
____

## Description
An implementation of the `StringableBuilder` interface with additional features.

## Synopsis
```php
class StringBuilder implements im\util\StringableBuilder, Stringable {

    // Constants
    public MODE_BOTH = 0
    public MODE_LEFT = -1
    public MODE_RIGHT = 1

    // Methods
    public __construct(null|string $str = NULL)
    public getStream(): im\io\Stream
    public split(string $separator): im\util\MutableStructuredList
    public substrpos(string|int $offset, string|int|null $length = NULL, bool $ci = FALSE, int $mode = im\util\StringBuilder::MODE_LEFT): null|static
    public substr(int $offset, null|int $length = NULL): static
    public strpos(string $substr, int $offset = 0, bool $ci = FALSE, int $mode = im\util\StringBuilder::MODE_LEFT): int
    public replace(array|string $search, array|string $replace, bool $ci = FALSE): void
    public trim(null|string $chars = NULL, int $mode = im\util\StringBuilder::MODE_BOTH): void
    public insert(int $offset, string ...$texts): void
    public insertFormat(int $offset, string $format, mixed ...$texts): void
    public append(string ...$texts): void
    public appendFormat(string $format, mixed ...$texts): void
    public prepend(string ...$texts): void
    public prependFormat(string $format, mixed ...$texts): void
    public beginsWith(string $text, bool $ci = FALSE): bool
    public endsWith(string $text, bool $ci = FALSE): bool
    public contains(string $text, bool $ci = FALSE): bool
    public equal(string $text, bool $ci = FALSE): bool
    public clear(): void
    public length(): int
    public toString(): string
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__StringBuilder&nbsp;::&nbsp;MODE\_BOTH__](util-StringBuilder-prop_MODE_BOTH.md) |  |
| [__StringBuilder&nbsp;::&nbsp;MODE\_LEFT__](util-StringBuilder-prop_MODE_LEFT.md) |  |
| [__StringBuilder&nbsp;::&nbsp;MODE\_RIGHT__](util-StringBuilder-prop_MODE_RIGHT.md) |  |

## Methods
| Name | Description |
| :--- | :---------- |
| [__StringBuilder&nbsp;::&nbsp;\_\_construct__](util-StringBuilder-__construct.md) |  |
| [__StringBuilder&nbsp;::&nbsp;getStream__](util-StringBuilder-getStream.md) | Get a stream that will be connected to the dataset of this builder |
| [__StringBuilder&nbsp;::&nbsp;split__](util-StringBuilder-split.md) | Split the current string into a list |
| [__StringBuilder&nbsp;::&nbsp;substrpos__](util-StringBuilder-substrpos.md) | A combination of `substr` and `strpos` |
| [__StringBuilder&nbsp;::&nbsp;substr__](util-StringBuilder-substr.md) | Return a portion of the string by an offset and length |
| [__StringBuilder&nbsp;::&nbsp;strpos__](util-StringBuilder-strpos.md) | Find the position of the first/last occurrence of a substring |
| [__StringBuilder&nbsp;::&nbsp;replace__](util-StringBuilder-replace.md) | Replace all occurrences in the string |
| [__StringBuilder&nbsp;::&nbsp;trim__](util-StringBuilder-trim.md) | Strip whitespaces and/or custom characters from the beginning and/or end of the string |
| [__StringBuilder&nbsp;::&nbsp;insert__](util-StringBuilder-insert.md) | Insert strings to a specific position in the current string |
| [__StringBuilder&nbsp;::&nbsp;insertFormat__](util-StringBuilder-insertFormat.md) | Insert a formated string to a specific position in the current string |
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
