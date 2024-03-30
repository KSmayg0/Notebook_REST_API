<?php


ini_set('display_errors',1);
error_reporting(E_ALL);

# Регистрация классов
spl_autoload_register(function($class) {
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    include __DIR__ . DIRECTORY_SEPARATOR .$class.'.php';
});

include(__DIR__ . '/Helpers/dev.php');

use Router\Router;

Router::generateRoutes();

debugArrayThenDie(Router::get($_SERVER));

?>