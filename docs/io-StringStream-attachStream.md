# [I/O](io.md) / [StringStream](io-StringStream.md) :: attachStream
 > im\io\StringStream
____

## Description
Attach a referenced string variable.

This will replace the internal string used to store the string data.
Seen as this is a referenced argument, any changes made to this instance
will reflect the referenced string ouside of this scope.

 > This is equal to opening a stream, meaning that the mode used to create the instance, will affect the referenced string. For an example if the mode is 'w' or 'w+', the referenced string will be truncated to 0 size. If the mode is 'a' or 'a+', the pointer is set to the end, although this only affects 'a+' when reading, since 'a' always appends written data.  

## Synopsis
```php
public attachStream(string &$stream): void
```

## Parameters
| Name | Description |
| :--- | :---------- |
| stream | A referenced string to replace the internal string variable. |
