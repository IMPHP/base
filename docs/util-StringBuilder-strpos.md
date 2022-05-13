# [Utilities](util.md) / [StringBuilder](util-StringBuilder.md) :: strpos
 > im\util\StringBuilder
____

## Description
Find the position of the first/last occurrence of a substring.

## Synopsis
```php
public strpos(string $substr, int $offset = 0, bool $ci = FALSE, int $mode = im\util\StringBuilder::MODE_LEFT): int
```

## Parameters
| Name | Description |
| :--- | :---------- |
| substr | Substring to search for. |
| offset | Offset to start the search from. |
| ci | Whether to use case-insensitive search. |
| mode | Whether to search left-to-right _(first occurrence)_ or right-to-left _(last occurrence)_. |
