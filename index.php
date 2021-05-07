<?php
require_once __DIR__. '/vendor/autoload.php';

use app\core\Application;

$app = new Application();

$router->get('/', function(){
    return "Hola Mundo";
});

$router->get('/contact', function(){
    return "Contact";
});

// $router->post('/contact', function(){
//     return "Hola Mundo";
// });

$app->run();