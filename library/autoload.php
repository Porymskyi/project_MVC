<?php


require_once ROOT_PATH . 'library' . DR . 'Core' . DR . 'Config.php';

$appPath = APP_PATH.'app'.DR.'Controller';
foreach (scandir($appPath) as $item) {
    if(!in_array($item, ['.', '..']))
    {
        if(is_file($appPath.DR.$item)) {
            require_once $appPath.DR.$item;
        }
    }
}
unset($appPath);
require_once ROOT_PATH . 'library' . DR . 'Core' . DR . 'Router.php';
