<?php
session_start();

include __DIR__ . "\..\config.php";

use App\Controllers\MessageAdminController;
use App\Database\MicroBlogUsers;
use App\Database\MicroBlogMessages;
use App\Controllers\FrontController;
use App\Controllers\MessageController;

if (strpos($_SERVER['REQUEST_URI'], '/user/register') !== false) {
    $controller = new FrontController();
    $controller->register();
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'], '/user/login') !== false) {
    $controller = new FrontController();
    $controller->login();
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'], '/message/indexAdmin') !== false) {
    $controller = new MessageAdminController();
    $controller->index();
    return 0;
}

if (strpos($_SERVER['REQUEST_URI'], '/message/index') !== false) {
    $controller = new MessageController();
    $controller->index();

    return 0;
}

$controller = new FrontController();
$controller->index();