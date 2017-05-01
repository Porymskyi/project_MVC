<?php

define('DR', DIRECTORY_SEPARATOR);
//Указываем путь деректории к проекту
define('ROOT_PATH',realpath(__DIR__.DR.'..') . DR);
//Путь к приложению на его файла
define('APP_PATH', realpath(ROOT_PATH.'application') . DR);
//Путь к конфигам сайта ..
define('CONFIG_PATH', realpath(APP_PATH.'config') . DR);

require_once ROOT_PATH . 'library' . DR . 'autoload.php';

echo '<pre>' . print_r(\Core\Config::load(), true) . '</pre>';
echo '<pre>' . print_r(\Core\Config::load('db.username'), true) . '</pre>';

$router = new \Core\Router();
echo  $router->run();
echo "test";