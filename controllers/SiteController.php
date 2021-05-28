<?php

namespace app\controllers;
//use app\core\Application;
use app\core\Controller;

class SiteController extends Controller
{
    public function home()
    {
        //return Application::$app->router->renderView('home');
        return $this->render('home');
    }
    
    public function contact()
    {
        //return Application::$app->router->renderView('contact');
        return $this->render('contact');
    }

    //se ejecuta con POST
    public function handleContact()
    {
        return "Procesando información";
    }

    //se podria crear aca render pero no es optimo, se debe generar como clase padre
}