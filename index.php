<?php
    require_once __DIR__ . "/global_loader.php";
    use smarty\templateEngine\TemplateEngine;

    $smarty = new TemplateEngine();
    print_r($smarty);