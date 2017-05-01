<?php


namespace Core;

class Router {
    private $routers;

    public  function __construct()
    {
        $this->routers = Config::load('router');
    }

    /**
     * Обработка ГКШ запросов
     */
    public function run () {
        //1.Парсинг строки
        $uri = strtolower($_SERVER['REQUEST_URI']);
        echo 'uri';
        foreach ($this->routers as $nameRouter => $params) {
            if ($params['url_pattern'] == $uri) {
                if (array_key_exists('default', $params)) {
                    $controllerName = $params['default']['controller'];
                    $actionName = $params['default']['action'];
                    $controllerObject = "App\\Controller\\{$controllerName}Controller";
                    if (class_exists($controllerObject)){
                        $controllerObject = new $controllerObject();
                        if (method_exists($controllerObject, $actionName . 'Action')) {
                            $actionName .= "Action";
                            return $controllerObject->{$actionName}();
                        }
                    }
                }
                break;
            }
        }

    }
}