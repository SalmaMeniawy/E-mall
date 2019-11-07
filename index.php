<?php
require_once __DIR__ . "/global_loader.php";

use smarty\templateEngine\TemplateEngine;
use function helpers\config;

$smarty = TemplateEngine::get_smarty();
$array = ['thor', 'loki', 'odin'];
$smarty->assign("gods", $array);
$smarty->display("index.tpl.php");
