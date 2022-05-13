# [Base](base.md) / [Utilities](util.md) / StringableBuilder
 > im\util\StringableBuilder
____

## Description
Defines a simple string builder.

## Synopsis
```php
interface StringableBuilder implements Stringable {

    // Methods
    getStream(): im\io\Stream
    insert(int $offset, string ...$texts): void
    append(string ...$texts): void
    prepend(string ...$texts): void
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
| [__StringableBuilder&nbsp;::&nbsp;getStream__](util-StringableBuilder-getStream.md) | Get a stream that will be connected to the dataset of this builder |
| [__StringableBuilder&nbsp;::&nbsp;insert__](util-StringableBuilder-insert.md) | Insert strings to a specific position in the current string |
| [__StringableBuilder&nbsp;::&nbsp;append__](util-StringableBuilder-append.md) | Append strings to the end of the current string |
| [__StringableBuilder&nbsp;::&nbsp;prepend__](util-StringableBuilder-prepend.md) | Prepend strings to the beginning of the current string |
| [__StringableBuilder&nbsp;::&nbsp;clear__](util-StringableBuilder-clear.md) | Clear this StringBuilder |
| [__StringableBuilder&nbsp;::&nbsp;length__](util-StringableBuilder-length.md) | Get the current length of this StringBuilder |
| [__StringableBuilder&nbsp;::&nbsp;toString__](util-StringableBuilder-toString.md) | Return a PHP `string` of this StringBuilder |
| [__StringableBuilder&nbsp;::&nbsp;\_\_toString__](util-StringableBuilder-__toString.md) |  |
