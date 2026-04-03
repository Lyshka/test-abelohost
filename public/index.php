<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$smarty = new Smarty\Smarty();
$smarty->setTemplateDir(__DIR__ . '/../templates');
$smarty->setCompileDir(__DIR__ . '/../templates_c');
$smarty->setCacheDir(__DIR__ . '/../cache');
$smarty->setConfigDir(__DIR__ . '/../configs');

$smarty->assign('title', 'PHP + Smarty');
$smarty->assign('message', 'Smarty успешно подключен');

$smarty->display('index.tpl');
