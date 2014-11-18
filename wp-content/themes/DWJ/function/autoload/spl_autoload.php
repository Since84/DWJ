<?php

function my_autoloader($class) {
    include 'class/Service/' . $class . '.class.php';
}

spl_autoload_register('my_autoloader');