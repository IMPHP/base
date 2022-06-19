# Base
____

## Description
Base package for IMPHP containing some core classes and packages.

## Packages
| Name | Description |
| :--- | :---------- |
| [Utilities](util.md) | Utility package that is bundled with IMPHP Base |
| [I/O](io.md) | Small IO package that is bundled with IMPHP Base |
| [Debug](debug.md) | A sub-package with some basic debug features |
| [ToolBox](toolbox.md) | Toolbox is a package containing mostly tools to insert into classes like traits |
| [Features](features.md) | Some basic feature interfaces |

## Interfaces
| Name | Description |
| :--- | :---------- |
| [ClassLoader](base-ClassLoader.md) | Interface defining a basic class loader |

## Classes
| Name | Description |
| :--- | :---------- |
| [ImClassLoader](base-ImClassLoader.md) | An implementation of the `ClassLoader` interface |
| [ErrorCatcher](base-ErrorCatcher.md) | Try running some code while catching any errors |
| [Shift](base-Shift.md) | This class contains a few convertion methods |
| [Version](base-Version.md) | Semantic Version extraction and comparison  This class can be used to compare two semantic version strings and/or retrieve information from a version string |
