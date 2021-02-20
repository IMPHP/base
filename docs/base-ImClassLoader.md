# [Base](base.md) / ImClassLoader
 > im\ImClassLoader
____

## Description
An implementation of the `ClassLoader` interface.

This ClassLoader implements features such as `PSR0` and `PSR4` lookup,
it supports class map files for caching and encresed speed along with
prefixes and more.

## Synopsis
```php
final class ImClassLoader implements im\ClassLoader {

    // Methods
    public static load(): static
    public __construct()
    public addClassExtension(string $extension): void
    public addClassPrefix(string $prefix, string $localDir): void
    public addClassMap(null|string $basePath, array $map): void
    public loadClassMap(string $file): void
    public addBasePath(string $path): void
    public findClass(string $class): null|string
    public enableAutoload(): bool
    public disableAutoload(): bool
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__ImClassLoader&nbsp;::&nbsp;load__](base-ImClassLoader-load.md) | Quick load the ClassLoader statically |
| [__ImClassLoader&nbsp;::&nbsp;\_\_construct__](base-ImClassLoader-__construct.md) |  |
| [__ImClassLoader&nbsp;::&nbsp;addClassExtension__](base-ImClassLoader-addClassExtension.md) | Add a new class extension to search for  By default the loader searches for class files with extension 'php' |
| [__ImClassLoader&nbsp;::&nbsp;addClassPrefix__](base-ImClassLoader-addClassPrefix.md) | Add a new PSR4 prefix to the class search  This works like a form of alias and the result is not meant to produce a complete path |
| [__ImClassLoader&nbsp;::&nbsp;addClassMap__](base-ImClassLoader-addClassMap.md) | Add a class map  The class map should be a mapped array where class name is the key and file path the value |
| [__ImClassLoader&nbsp;::&nbsp;loadClassMap__](base-ImClassLoader-loadClassMap.md) | Load a class map from a file |
| [__ImClassLoader&nbsp;::&nbsp;addBasePath__](base-ImClassLoader-addBasePath.md) | Add a new base path containing classes to load  Base paths are paths where this loader searches for classes |
| [__ImClassLoader&nbsp;::&nbsp;findClass__](base-ImClassLoader-findClass.md) | Locate the path to a class file |
| [__ImClassLoader&nbsp;::&nbsp;enableAutoload__](base-ImClassLoader-enableAutoload.md) | Enable class auto loading |
| [__ImClassLoader&nbsp;::&nbsp;disableAutoload__](base-ImClassLoader-disableAutoload.md) | Disable class auto loading |
