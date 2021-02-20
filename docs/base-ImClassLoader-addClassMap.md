# [Base](base.md) / [ImClassLoader](base-ImClassLoader.md) :: addClassMap
 > im\ImClassLoader
____

## Description
Add a class map

The class map should be a mapped array
where class name is the key and file path the value.

## Synopsis
```php
public addClassMap(null|string $basePath, array $map): void
```

## Parameters
| Name | Description |
| :--- | :---------- |
| basePath | Optional base path that is added to the class paths in the map |
| map | Mapped array where key is full class name and value is<br />the file path relative to $basePath. |
