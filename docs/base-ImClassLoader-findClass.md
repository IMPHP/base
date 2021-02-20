# [Base](base.md) / [ImClassLoader](base-ImClassLoader.md) :: findClass
 > im\ImClassLoader
____

## Description
Locate the path to a class file.

## Synopsis
```php
public findClass(string $class): null|string
```

## Parameters
| Name | Description |
| :--- | :---------- |
| class | Full name of the class (Including namespace). |

## Return
Full path to the class file, or `NULL` if no file could be found.
