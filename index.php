<?php

require_once __DIR__.'/vendor/autoload.php';

use App\Controllers\MenuController;


$menuController = new MenuController();
$menuController->run();
