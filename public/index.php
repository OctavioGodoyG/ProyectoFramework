<?php
require_once __DIR__. '/../vendor/autoload.php';

use app\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/public/', [\app\controllers\SiteController::class, 'home']);
$app->router->get('/contact',[\app\controllers\SiteController::class, 'contact']);
$app->router->post('/contact', [\app\controllers\SiteController::class, 'handleContact']);
$app->run();