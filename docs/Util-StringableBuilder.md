# [Base](Base.md) / [Util](Util.md) / StringableBuilder
 > im\util\StringableBuilder
____

## Description
Defines a simple string builder.

## Synopsis
```php
interface StringableBuilder extends Stringable {

    // Methods
    append(string|Stringable $texts): void
    prepend(string|Stringable $texts): void
    clear(): void
    length(): int
    toString(): string
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__StringableBuilder&nbsp;::&nbsp;append__](Util-StringableBuilder_append.md) | Append strings to the end of the current string |
| [__StringableBuilder&nbsp;::&nbsp;prepend__](Util-StringableBuilder_prepend.md) | Prepend strings to the beginning of the current string |
| [__StringableBuilder&nbsp;::&nbsp;clear__](Util-StringableBuilder_clear.md) | Clear this StringBuilder |
| [__StringableBuilder&nbsp;::&nbsp;length__](Util-StringableBuilder_length.md) | Get the current length of this StringBuilder |
| [__StringableBuilder&nbsp;::&nbsp;toString__](Util-StringableBuilder_toString.md) | Return a PHP `string` of this StringBuilder |
