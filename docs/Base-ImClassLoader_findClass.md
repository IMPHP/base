# [Base](Base.md) / [ImClassLoader](Base-ImClassLoader.md) :: findClass
 > im\ImClassLoader
____

## Description
Locate the path to a class file.

## Synopsis
```php
findClass(string $class): ?string
```

## Parameters
| Name | Description |
| :--- | :---------- |
| class | Full name of the class (Including namespace). |

## Return
Full path to the class file, or `NULL` if no file could be found.
