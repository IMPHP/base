# [Base](base.md) / Version
 > im\Version
____

## Description
Semantic Version extraction and comparison

This class can be used to compare two semantic version strings and/or
retrieve information from a version string. It splits a version into
several parts of which each part can be extracted individually.

__Version Scheme__

| Description                                                      | Example               |
| ---------------------------------------------------------------- | --------------------- |
| \<major>[.\<minor>[.\<patch>]][-\<release>][.\<build>][+\<meta>] | 1.0.0-beta.1+20220130 |

 > All of the properties are readonly and will return a default value if the version string did not include that part. To see if a specific part of the version was actually included you can use `isset()`.  

## Synopsis
```php
class Version implements Stringable {

    // Properties
    public int $major
    public int $minor
    public int $patch
    public int $build
    public string $release
    public null|string $meta
    public string $version

    // Methods
    public static validate(im\Version|string $version, string $rule): bool
    public __construct(string $version)
    public compare(im\Version|string $version, null|string $operator = NULL): int|bool
}
```

## Properties
| Name | Description |
| :--- | :---------- |
| [__Version&nbsp;::&nbsp;$major__](base-Version-var_major.md) |  |
| [__Version&nbsp;::&nbsp;$minor__](base-Version-var_minor.md) |  |
| [__Version&nbsp;::&nbsp;$patch__](base-Version-var_patch.md) |  |
| [__Version&nbsp;::&nbsp;$build__](base-Version-var_build.md) |  |
| [__Version&nbsp;::&nbsp;$release__](base-Version-var_release.md) |  |
| [__Version&nbsp;::&nbsp;$meta__](base-Version-var_meta.md) |  |
| [__Version&nbsp;::&nbsp;$version__](base-Version-var_version.md) |  |

## Methods
| Name | Description |
| :--- | :---------- |
| [__Version&nbsp;::&nbsp;validate__](base-Version-validate.md) | Validate a version based on a rule set  You can validate by adding multiple `AND`/`OR` statements using `||` and spaces |
| [__Version&nbsp;::&nbsp;\_\_construct__](base-Version-__construct.md) |  |
| [__Version&nbsp;::&nbsp;compare__](base-Version-compare.md) | Compare two versions |
