# IMPHP / Base
____

This repository contains some basic tools that may be useful to any type of project. It serves as the base for other IMPHP packages, but is build to work as a stand-alone package.

### Included

What is currently included in this repo is, among other things, the [Utility](src/util/) package that packs a lot of great Java-like collection classes. PHP arrays are fine for some tasks, but due to their complete lack of proper structure and behavior _(which is what makes them so good at certain tasks)_, they simply are not suited for everything. Properly defined tools for specific tasks makes the code a lot more readable, easier to use and debug.

Another thing that is packed in here, is the [I/O](src/io/) package. This is a small sub-package that contains some stream classes that makes it a lot more friendly to deal with streams like files and the likes. This was mainly to be used in the `Http` package, but a stream is a global tool that is not just useful to a single package and it's specific purpose, so this made it's way into the base package instead.

Along with the above sub-packages, the base package also has a few of it's own classes. One is a `ClassLoader`, though it may not be of need to most, but there is also `ErrorCatcher` and a conversion class.

### Full Documentation

You can view the [Full Documentation](docs/base.md) to lean more about what this offers.

### Installation

__Using .phar library__

```sh
wget https://github.com/IMPHP/base/releases/download/<version>/imphp-base.phar
```

```php
require "imphp-base.phar";

...
```

__Clone via git__

```sh
git clone https://github.com/IMPHP/base.git imphp/base/
```

__Composer _(Packagist)___

```sh
composer require imphp/base
```

### PHP Version

This package support PHP `>= 8.0`. The reason for this is simple. A library project needs to keep compatibility for a long time, so you don't start a new project by using the oldest technology.

PHP 8 packs some really great changes which would not be useful for a long time, would this project start with PHP 7 support _(PHP 5 is dead, deal with it)_. One of the major changes, is the fact that proper type hints are almost complete. The really slow and stupid road that leads to this point, makes PHP 7 a mess and also makes all it's changes in type hinting up to PHP 8 quiet useless, since half of your arguments and such will still go without. Union types are one thing to miss, but the fact that they did not just add support for __ALL__ build-in types in one go, is beyond logic. Instead they add one type for each new `7.x` version. So when it came to support a dead version 5, a messy version 7 or a more complete modern version 8, the choice was easy. Like I said, the version you pick is one that you will stick with for a long time, while slowly upgrading your way up.

## __Powered by PHP 8__
