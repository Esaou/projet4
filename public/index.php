<?php

declare(strict_types=1);  

define('ROOT',dirname(__DIR__));

require '../vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new App\Service\Router();
$router->run(); 