# [Base](base.md) / [ImClassLoader](base-ImClassLoader.md) :: addClassExtension
 > im\ImClassLoader
____

## Description
Add a new class extension to search for

By default the loader searches for class files with extension
'php'.

 > Class extensions has no affect on class maps. This only affects PSR0/PSR4 searches.  

## Synopsis
```php
public addClassExtension(string $extension): void
```

## Parameters
| Name | Description |
| :--- | :---------- |
| extension | File extension to add |
