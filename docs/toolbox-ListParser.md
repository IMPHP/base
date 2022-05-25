# [Base](base.md) / [ToolBox](toolbox.md) / ListParser
 > im\toolbox\ListParser
____

## Description
A text parser that can parse simple word bound lines

This parser can be used to parse simple custom text config files.
It does not have a lot of fancy features, which makes it fast and simple.

## Synopsis
```php
trait ListParser {

    // Methods
    protected scanLine(string $line, string ...$keys): null|array
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__ListParser&nbsp;::&nbsp;scanLine__](toolbox-ListParser-scanLine.md) | Scan a line and return the result in an array  Finds each word (whitespace devision) and adds it to the array |

## Example 1
This example uses a simple file list of routes that can be
used with a router.

```txt
# This is a comment
#
# Route Name   |   Request Method   |   Route Path   |   Controller
# ----------       --------------       ----------       ----------

  none             GET|POST             /page/{id:int}   \namespace\MyController
```

Now we can parse each line of actual route information:

```php
$parser = new class() {
    use ListParser { scanLine as public; }
};

$stream = new FileStream("route.lst", "r");
while (($line = $stream->readLine()) != null) {
    if (($line = $parser->scanLine($line, "name", "method", "route", "controller")) != null) {
        print_r($line);
    }
}
```
```sh
Array
(
    [name] => none
    [method] => GET|POST
    [route] => /page/{id:int}
    [controller] => \namespace\MyController
)
```
