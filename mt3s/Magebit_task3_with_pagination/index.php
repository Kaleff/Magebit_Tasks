<?php
    // FRONT CONTROLLER
    // COMMON SETTING
    ini_set("display_errors",1);
    error_reporting(E_ALL);
    // SYSTEM FILE UPLOAD
    define("ROOT", dirname(__FILE__)); //Gets directory with the project
    require_once ROOT . "/components/autoloader.php";

    // CALLING ROUTER
    $router = new Router();
    $router->run();