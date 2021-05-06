<?php
//echo "holi";
require("Application.php");

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