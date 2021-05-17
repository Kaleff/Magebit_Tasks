<?php
spl_autoload_register("autoLoader");

function autoLoader($classname) {
    $fileFound = false;
    $directories = array (
        "components/",
        "models/",
        "controllers/",
        "view/",
        "view/main/"
    );
    foreach ($directories as $path) {
        $fullPath = $path . $classname . ".php";
        if (file_exists($fullPath)) {
            include_once $fullPath;
            $fileFound = true;
        }
    }
    return $fileFound;
}