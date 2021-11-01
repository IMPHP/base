<?php

if (version_compare(PHP_VERSION, '8.0.0') < 0) {
    echo "PHP 8 or above is required!"; exit(1);
}

require "static.php";
require "ImClassLoader.php";

\im\ImClassLoader::load();
