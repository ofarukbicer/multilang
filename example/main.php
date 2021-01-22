<?php

require "../src/Multilang.php"; // Bunu vendor autoload dosyası nerde ise onunla değiştirin.

use Multilang\Multilang;

$lang = new Multilang("lang");

echo $lang->load("hello");