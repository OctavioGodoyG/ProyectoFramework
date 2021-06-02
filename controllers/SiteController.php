<?php

namespace app\controllers;
//use app\core\Application;

use app\core\Request;
use app\core\Controller;
use app\core\Application;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'name'=>'Juan ',
            'surname' => 'Perez',
        ];
        //return Application::$app->router->renderView('home');
        return $this->render('home',$params);
    }
    
    public function contact()
    {
        //return Application::$app->router->renderView('contact');
        return $this->render('contact');
    }

    //se ejecuta con POST
    public function handleContact(Request $request)
    {
        //$body = Application::$app->request->getBody();
        //var_dump($_POST);
        $body = $request->getBody();
        return "Procesando información";
    }

    //se podria crear aca render pero no es optimo, se debe generar como clase padre
}