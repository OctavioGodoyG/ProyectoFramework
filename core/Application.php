<?php

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