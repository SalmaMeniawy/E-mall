<?php
    require_once __DIR__ . "/vendor/autoload.php";
    use smarty\templateEngine\TemplateEngine;

    $smarty = TemplateEngine::get_smarty();

    print_r($smarty);