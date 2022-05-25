# [Base](base.md) / [Version](base-Version.md) :: validate
 > im\Version
____

## Description
Validate a version based on a rule set

You can validate by adding multiple `AND`/`OR` statements using `||` and spaces.

## Synopsis
```php
public static validate(im\Version|string $version, string $rule): bool
```

## Example 1
```php
Version::validate($version, ">=2.0.0 !=2.2.0 < 3.0 || >4.0");
```

## Example 2
```php
Version::validate($version, "~2.2.0");
```
