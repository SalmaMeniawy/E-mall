<?php
    require_once __DIR__ . "/global_loader.php";
    use smarty\templateEngine\TemplateEngine;
    use function helpers\config;

    $smarty = TemplateEngine::get_smarty();
    
    $array = ['thor','loki','odin'];
    $smarty->assign("gods", $array);
    
    $smarty->template_dir = __DIR__ . config("TemplateDir");
    $smarty->compile_dir  = __DIR__ . config("cmpTemplateDir");
    $smarty->display("homepage.tpl.php");


