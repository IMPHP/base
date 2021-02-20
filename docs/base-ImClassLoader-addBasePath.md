# [Base](base.md) / [ImClassLoader](base-ImClassLoader.md) :: addBasePath
 > im\ImClassLoader
____

## Description
Add a new base path containing classes to load

Base paths are paths where this loader searches
for classes. Each part of a class namespace should be resolved
to folders, starting in the root of one of the base paths.

Classes outside of namespaces will be searched for
in the root of the base paths.

## Synopsis
```php
public addBasePath(string $path): void
```

## Parameters
| Name | Description |
| :--- | :---------- |
| path | Base search path |

## Example 1
```php
$loader->addBasePath("./src"); // Class "im\util\Map" would be located in "./src/im/util/Map.php" depending on prefixes
```
