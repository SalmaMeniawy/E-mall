<?php
    require_once __DIR__ . "/vendor/autoload.php";
    require_once __DIR__ . "/resources/template_engine.php";
    require_once __DIR__ . "/utilities/helpers.php";

    function autoload(string $classname){
        $file = __DIR__ . "/models/" . strtolower($classname) . ".php";
        if(file_exists($file)){
            require_once $file;
        }
    }

    spl_autoload_register("autoload");