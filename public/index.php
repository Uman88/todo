<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();

require_once '../app/core/init.php';

$route = isset($_GET['route']) ? $_GET['route'] : 'todo';

if ($_SERVER['REQUEST_URI'] === '/') {
    header('Location: index.php?id=2');
} else {
    if (file_exists(PAGE . '/' . $route . '.php')) {
        require_once PAGE . '/' . $route . '.php';
    } elseif (file_exists(CORE . '/' . $route . '.php')) {
        require_once CORE . '/' . $route . '.php';
    } else {
        http_response_code(404);
        require_once '../app/page/404.php';
    }
}