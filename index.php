<?php

use lib\Init;

function autoload($className) {
    include str_replace('\\', '/', $className) . '.php';
}

spl_autoload_register('autoload');

$controller = 'Requests';

$action = 'index';

$param = 0;

if (isset($_SERVER['PATH_INFO'])) {
    $url = explode('/', $_SERVER['PATH_INFO']);

    $param = $url[1];

    if (!is_numeric($url[1])) {
        $controller = $url[1];
    }
    
    if (isset($url[2])) {
        $param = $url[2];
    }

    if (isset($url[2]) && !is_numeric($url[2]) && $url[2]) {
        $action = $url[2];
    }

    if (isset($url[3]) && $url[3]) {
        $param = $url[3];
    }
}

Init::init();

call_user_func("controllers\\$controller::$action", (int)$param);
