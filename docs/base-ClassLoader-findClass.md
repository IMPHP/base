# [Base](base.md) / [ClassLoader](base-ClassLoader.md) :: findClass
 > im\ClassLoader
____

## Description
Locate the path to a class file.

## Synopsis
```php
findClass(string $class): null|string
```

## Parameters
| Name | Description |
| :--- | :---------- |
| class | Full name of the class (Including namespace). |

## Return
Full path to the class file, or `NULL` if no file could be found.
