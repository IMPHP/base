# [Base](base.md) / Utilities
____

## Description
Utility package that is bundled with IMPHP Base.

## Interfaces
| Name | Description |
| :--- | :---------- |
| [Collection](util-Collection.md) | Defines a base collection interface |
| [ImmutableListArray](util-ImmutableListArray.md) | Defines an unmodifiable unstructured list |
| [ImmutableMappedArray](util-ImmutableMappedArray.md) | Defines an unmodifiable map |
| [ImmutableStructuredList](util-ImmutableStructuredList.md) | Defines an unmodifiable structured list |
| [ImmutableStringMappedArray](util-ImmutableStringMappedArray.md) | Defines an unmodifiable map using string keys |
| [ImmutableObjectMappedArray](util-ImmutableObjectMappedArray.md) | Defines an unmodifiable map using mixed/object keys |
| [MutableListArray](util-MutableListArray.md) | An modifiable structured list implementation |
| [MutableStructuredList](util-MutableStructuredList.md) | Defines a modifiable structured list |
| [MutableMappedArray](util-MutableMappedArray.md) | Defines a modifiable map |
| [MutableStringMappedArray](util-MutableStringMappedArray.md) | Defines a modifiable map using string keys |
| [MutableObjectMappedArray](util-MutableObjectMappedArray.md) | Defines a modifiable map using mixed/object keys |
| [StringableBuilder](util-StringableBuilder.md) | Defines a simple string builder |
| [~MapArray~](util-MapArray.md) | Defines an interface for a mapped array |
| [~ListArray~](util-ListArray.md) | Defines an interface for a list array |
| [~IndexArray~](util-IndexArray.md) | Defines an interface for a indexed array |

## Traits
| Name | Description |
| :--- | :---------- |
| [PropertyAccess](util-PropertyAccess.md) | Small trait to access get/set methods via property access |

## Classes
| Name | Description |
| :--- | :---------- |
| [BaseCollection](util-BaseCollection.md) | An abstract implementation of the `Collection` interface |
| [Stackable](util-Stackable.md) | Defines a basic stackable class |
| [StringBuilder](util-StringBuilder.md) | An implementation of the `StringableBuilder` interface with additional features |
| [Struct](util-Struct.md) | An extended stdClass-like class  The major purpose with this class, is to provide a better interface to be used as a replacement for PHP's stdClass |
| [ArgV](util-ArgV.md) | This class provides a unified API to deal with shell arguments (argv) |
| [Vector](util-Vector.md) | Defines an unmodifiable unstructured list |
| [Map](util-Map.md) | An unmodifiable map implementation |
| [HashMap](util-HashMap.md) | An modifiable map implementation using hashed keys |
| [HashSet](util-HashSet.md) | An modifiable unstructured list implementation |
| [FIFOStack](util-FIFOStack.md) | A FIFO Stack (Queue) implementation |
| [LIFOStack](util-LIFOStack.md) | A LIFO Stack implementation |
| [HashSet](util-HashSet.md) | An modifiable unstructured list implementation |
| [~Set~](util-Set.md) | An modifiable unstructured list implementation |
| [~Stack~](util-Stack.md) | This stack-able pushes values to the top while also popping them from the top |
| [~Queue~](util-Queue.md) | This stack-able pushes values to the top while popping them from the bottom |
| [~DataTable~](util-DataTable.md) | This is a light absstraction to dealing with a PHP array |
| [~LockTable~](util-LockTable.md) | Extension to `DataTable` that enables immutability |
| [~HashTable~](util-HashTable.md) | Extension to `DataTable` that allows using multiple data types as key |
