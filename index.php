<?php

use lib\Init;

function autoload($className) {
    include str_replace('\\', '/', $className) . '.php';
}

spl_autoload_register('autoload');

$controller = 'Requests';

$action = 'index';

$params = [];

if (isset($_SERVER['PATH_INFO'])) {
    $params = explode('/', $_SERVER['PATH_INFO']);

    array_shift($params);

    if (isset($params[0]) && $params[0] && !is_numeric($params[0])) {
        $controller = $params[0];

        unset($params[0]);
    }

    if (isset($params[1]) && $params[1] && !is_numeric($params[1])) {
        $action = $params[1];

        unset($params[1]);
    }

    array_values($params);
}

Init::init();

call_user_func_array("controllers\\$controller::$action", $params);
