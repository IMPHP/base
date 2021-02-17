# [Base](Base.md) / ImClassLoader
 > im\ImClassLoader
____

## Description
An implementation of the `ClassLoader` interface.

This ClassLoader implements features such as `PSR0` and `PSR4` lookup,
it supports class map files for caching and encresed speed along with
prefixes and more.

## Synopsis
```php
class ImClassLoader implements im\ClassLoader {

    // Methods
    static load(): static
    __construct(): mixed
    addClassExtension(string $extension): void
    addClassPrefix(string $prefix, string $localDir): void
    addClassMap(?string $basePath, array $map): void
    loadClassMap(string $file): void
    addBasePath(string $path): void
    findClass(string $class): ?string
    enableAutoload(): bool
    disableAutoload(): bool
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__ImClassLoader&nbsp;::&nbsp;load__](Base-ImClassLoader_load.md) | Quick load the ClassLoader statically |
| [__ImClassLoader&nbsp;::&nbsp;\_\_construct__](Base-ImClassLoader___construct.md) |  |
| [__ImClassLoader&nbsp;::&nbsp;addClassExtension__](Base-ImClassLoader_addClassExtension.md) | Add a new class extension to search for |
| [__ImClassLoader&nbsp;::&nbsp;addClassPrefix__](Base-ImClassLoader_addClassPrefix.md) | Add a new PSR4 prefix to the class search |
| [__ImClassLoader&nbsp;::&nbsp;addClassMap__](Base-ImClassLoader_addClassMap.md) | Add a class map |
| [__ImClassLoader&nbsp;::&nbsp;loadClassMap__](Base-ImClassLoader_loadClassMap.md) | Load a class map from a file |
| [__ImClassLoader&nbsp;::&nbsp;addBasePath__](Base-ImClassLoader_addBasePath.md) | Add a new base path containing classes to load |
| [__ImClassLoader&nbsp;::&nbsp;findClass__](Base-ImClassLoader_findClass.md) | Locate the path to a class file |
| [__ImClassLoader&nbsp;::&nbsp;enableAutoload__](Base-ImClassLoader_enableAutoload.md) | Enable class auto loading |
| [__ImClassLoader&nbsp;::&nbsp;disableAutoload__](Base-ImClassLoader_disableAutoload.md) | Disable class auto loading |
