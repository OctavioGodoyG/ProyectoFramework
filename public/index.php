<?php
require_once __DIR__. '/../vendor/autoload.php';

use app\core\Application;
$app = new Application();

$app->router->get('/', function(){
    return "Hola Mundo";
});

$app->router->get('/contact', 'contact');

// $router->post('/contact', function(){
//     return "Hola Mundo";
// });

$app->run();