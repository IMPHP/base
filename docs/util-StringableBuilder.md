# [Base](base.md) / [Utilities](util.md) / StringableBuilder
 > im\util\StringableBuilder
____

## Description
Defines a simple string builder.

## Synopsis
```php
interface StringableBuilder implements Stringable {

    // Methods
    append(Stringable|string ...$texts): void
    prepend(Stringable|string ...$texts): void
    clear(): void
    length(): int
    toString(): string

    // Inherited Methods
    __toString(): string
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__StringableBuilder&nbsp;::&nbsp;append__](util-StringableBuilder-append.md) | Append strings to the end of the current string |
| [__StringableBuilder&nbsp;::&nbsp;prepend__](util-StringableBuilder-prepend.md) | Prepend strings to the beginning of the current string |
| [__StringableBuilder&nbsp;::&nbsp;clear__](util-StringableBuilder-clear.md) | Clear this StringBuilder |
| [__StringableBuilder&nbsp;::&nbsp;length__](util-StringableBuilder-length.md) | Get the current length of this StringBuilder |
| [__StringableBuilder&nbsp;::&nbsp;toString__](util-StringableBuilder-toString.md) | Return a PHP `string` of this StringBuilder |
| [__StringableBuilder&nbsp;::&nbsp;\_\_toString__](util-StringableBuilder-__toString.md) |  |
