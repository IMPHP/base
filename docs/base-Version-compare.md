# [Base](base.md) / [Version](base-Version.md) :: compare
 > im\Version
____

## Description
Compare two versions

__Operators__

| Operator | Description         |
| -------- | ------------------- |
| =        | Equal to            |
| >        | Grater than         |
| <        | Smaller than        |
| >=       | Grater or equal to  |
| <=       | Smaller or equal to |
| ^        | Caret range         |
| ~        | Tilde range         |
| !<op>    | A 'not' addition that can be added in front of any operator to reverse the output |

 > The Caret and Tilde range options are based on Composers operators.  

## Synopsis
```php
public compare(im\Version|string $version, null|string $operator = NULL): int|bool
```

## Parameters
| Name | Description |
| :--- | :---------- |
| version | A version to compare against |
| operator | Optional operator. If `NULL` the method will return an `integer` based on the result.<br />The values are `-1` when smaller than, `1` when grater than and `0` if both versions<br />are equal. |
