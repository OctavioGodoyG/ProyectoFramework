<?php
//echo "holi";

$app = new Application();

$router = new Router();

$router->get('/', function(){
    return "Hola Mundo";
});

$app->run();