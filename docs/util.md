# [Base](base.md) / Utilities
____

## Description
Small utility package that is bundled with IMPHP Base.

## Interfaces
| Name | Description |
| :--- | :---------- |
| [Collection](util-Collection.md) | Defines a base collection interface |
| [StringableBuilder](util-StringableBuilder.md) | Defines a simple string builder |
| [ListArray](util-ListArray.md) | Defines an interface for a list array |
| [IndexArray](util-IndexArray.md) | Defines an interface for a indexed array |
| [MapArray](util-MapArray.md) | Defines an interface for a mapped array |

## Classes
| Name | Description |
| :--- | :---------- |
| [Map](util-Map.md) | An implementation of the `MapArray` interface |
| [HashMap](util-HashMap.md) | An implementation of the `MapArray` interface |
| [Vector](util-Vector.md) | An implementation of the `IndexArray` interface |
| [Set](util-Set.md) | An implementation of the `ListArray` interface |
| [HashSet](util-HashSet.md) | A much faster `Set` to be used when you have a lot of data |
| [BaseCollection](util-BaseCollection.md) | An abstract implementation of the `Collection` interface |
| [StringBuilder](util-StringBuilder.md) | An implementation of the `StringableBuilder` interface with additional features |
| [Struct](util-Struct.md) | An extended stdClass-like class  The major purpose with this class, is to provide a better interface to be used as a replacement for PHP's stdClass |
| [ArgV](util-ArgV.md) | This class provides a unified API to deal with shell arguments (argv) |
| [Stackable](util-Stackable.md) | Defines a basic stackable class |
| [Stack](util-Stack.md) | This stack-able pushes values to the top while also popping them from the top |
| [Queue](util-Queue.md) | This stack-able pushes values to the top while popping them from the bottom |
| [DataTable](util-DataTable.md) | This is a light absstraction to dealing with a PHP array |
| [LockTable](util-LockTable.md) | Extension to `DataTable` that enables immutability |
| [HashTable](util-HashTable.md) | Extension to `DataTable` that allows using multiple data types as key |
