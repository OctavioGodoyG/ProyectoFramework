<?php
require_once __DIR__. '/../vendor/autoload.php';

use app\core\Application;

try {
    //echo "1 antes de DotEnv\n";
    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
    //echo "2 DotEnv\n";
    $dotenv->load();
    //echo "3 cargo DotEnv\n";
}
 catch(Error $ex){
        echo $ex->getMessage();
}


$config = [
    'db' => [
        'dsn'=> $_ENV['DSN'],
        'user'=> $_ENV['USERNAME'],
        'password'=> $_ENV['PASSWORD'],
    ]
];
$app = new Application(dirname(__DIR__), $config);

//$app->router->get('/public/', [\app\controllers\SiteController::class, 'home']);

$app->router->get('/contact',[\app\controllers\SiteController::class, 'contact']);
$app->router->post('/contact', [\app\controllers\SiteController::class, 'handleContact']);

$app->router->get('/register',[\app\controllers\AuthController::class, 'register']);
$app->router->post('/register', [\app\controllers\AuthController::class, 'register']);

$app->router->get('/login',[\app\controllers\AuthController::class, 'login']);
$app->router->post('/login', [\app\controllers\AuthController::class, 'login']);
$app->run();