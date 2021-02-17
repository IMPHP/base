# [Base](Base.md) / [Util](Util.md) / Collection
 > im\util\Collection
____

## Description
Defines a base collection interface.

Arrays in PHP is a great internal tool because of their flexibility.
However they are not that great as parameters and return types for
this exact reason. It's dificult to keep track of their actual
content and their structure. Strict collection classes makes this
much easier when you can distinguish between a list or a map for example.

## Synopsis
```php
interface Collection extends IteratorAggregate {

    // Methods
    clear(): void
    length(): int
    toArray(): array
    copy(callable $sort = null): static
    equals(object $other): bool
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__Collection&nbsp;::&nbsp;clear__](Util-Collection_clear.md) | Clear the collection. This will remove all data from the |
| [__Collection&nbsp;::&nbsp;length__](Util-Collection_length.md) | Get the current length of the collection |
| [__Collection&nbsp;::&nbsp;toArray__](Util-Collection_toArray.md) | Builds a PHP array containing all of the current values within |
| [__Collection&nbsp;::&nbsp;copy__](Util-Collection_copy.md) | Clone this instance and return it |
| [__Collection&nbsp;::&nbsp;equals__](Util-Collection_equals.md) | Compare an object against this instance. |
