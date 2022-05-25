# [ToolBox](toolbox.md) / [ListParser](toolbox-ListParser.md) :: scanLine
 > im\toolbox\ListParser
____

## Description
Scan a line and return the result in an array

Finds each word (whitespace devision) and adds it to the array.
Each new word will be added as `key` from `$keys` argument in order.
So if the first key in `$keys` is `name`, then the first word will be added to
the array using `name` as key. It will only search for the amount of words that matches
the amount of keys, the rest of the line will remain unparsed.

 > If you need a whitespace in a word, you can escape it using `\`. Whitespaces are the only characters that excepts escaping. In any other case, the character `\` is just another character.  

## Synopsis
```php
protected scanLine(string $line, string ...$keys): null|array
```

## Parameters
| Name | Description |
| :--- | :---------- |
| line | The line that should be parsed |
| keys | Keys to scan for |
