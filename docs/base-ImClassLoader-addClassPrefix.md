# [Base](base.md) / [ImClassLoader](base-ImClassLoader.md) :: addClassPrefix
 > im\ImClassLoader
____

## Description
Add a new PSR4 prefix to the class search

This works like a form of alias and the result is not meant to produce
a complete path. All class files are treated as relative to one of the
defiend class paths using `addClassPath()`. The purpose is
to make changes to the beginning of namespaces, to redirect it
to a different sub-path.

For example:

```
my\namespace => my\namespace\src       >> [my\namespace\Class -> my/namespace/src/Class.php]
my\other\namespace => my\namespace     >> [my\other\namespace\Class -> my/namespace/Class.php]
```

## Synopsis
```php
public addClassPrefix(string $prefix, string $localDir): void
```

## Parameters
| Name | Description |
| :--- | :---------- |
| prefix | The part of the namespace to replace |
| localDir | The new part to replace it with |
