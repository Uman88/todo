<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once '../app/core/init.php';

$route = isset($_GET['route']) ? $_GET['route'] : 'todo';

if ($_SERVER['REQUEST_URI'] === '/') {
    header('Location: index.php?id=2');
} else {
    if (file_exists('../app/page/' . $route . '.php')) {
        require_once '../app/page/' . $route . '.php';
    } elseif (file_exists('../app/core/' . $route . '.php')) {
        require_once '../app/core/' . $route . '.php';
    } else {
        http_response_code(404);
        require_once '../app/page/404.php';
    }
}