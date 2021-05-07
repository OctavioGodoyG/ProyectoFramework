<?php
namespace app\core;

class Application{
    public Router $router;

    public function __construct()
    {
        
    }

    public function run()
    {
        $this->router->resolve();
    }

}