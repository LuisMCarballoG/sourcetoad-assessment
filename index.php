<?php

require_once __DIR__.'/vendor/autoload.php';

use App\Controllers\MenuController;
use App\Infrastructure\ServiceContainer;
use App\Services\JsonFileLoaderService;
use App\Services\KeyValueFormatterService;

$container = new ServiceContainer();
$container->register(
    JsonFileLoaderService::class,
    /** @return JsonFileLoaderService */
    fn () => new JsonFileLoaderService(__DIR__.'/Storage/Files/guests.json'),
);
$container->register(
    KeyValueFormatterService::class,
    /** @return KeyValueFormatterService */
    fn () => new KeyValueFormatterService(),
);

$menuController = new MenuController($container);
$menuController->run();
