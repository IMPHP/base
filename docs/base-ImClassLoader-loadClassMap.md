# [Base](base.md) / [ImClassLoader](base-ImClassLoader.md) :: loadClassMap
 > im\ImClassLoader
____

## Description
Load a class map from a file.

 > A class map file is a PHP file that returns an array with all the mappings.  

## Synopsis
```php
public loadClassMap(string $file): void
```

## Parameters
| Name | Description |
| :--- | :---------- |
| file | Path to a file containing a proper classmap PHP array.<br />The maps should be relative to the files location. |
