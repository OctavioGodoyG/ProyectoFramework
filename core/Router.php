<?php
namespace app\core;

class Router
{
    public Request $request;
    public Response $response;

    protected array $routes=[];

    public function __construct(Request $request, Response $response){
        $this->request =$request;
        $this->response =$response;
    }

    public function get($path, $callback){
        $this->routes['get'][$path]= $callback;
    }

    public function post($path, $callback){
        $this->routes['post'][$path]= $callback;
    }

    public function resolve(){
        // echo '<pre>';
        // var_dump($_SERVER);
        // echo '/<pre>';
        // exit;

        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;

        // echo "<pre>";
        // echo 'De Router.php';
        // echo "</pre>";
        // echo "<pre>";
        // echo '$path:';
        // var_dump($path);
        // echo '$method:';
        // var_dump($method);
        //echo '$callback:'; . $callback ;
        // echo "</pre>";

        if ($callback === false){
            // Application::$app->response->setStatusCode(404);
            $this->response->setStatusCode(404);
            // return 'not found';
            return $this->renderView('_404');
        }

        if (is_string($callback)){
            return $this->renderView($callback);
        }
        if(is_array($callback)){

            Application::$app->controller = new $callback[0]();
            
            //$bla = new app\controllers\SiteController();
            //$bla = $callback[0]();
            //$callback[0] = new $callback[0]();
            $callback[0] = Application::$app->controller;
            //var_dump($callback);
            //exit;
            
        }

        return call_user_func($callback, $this->request);

    }

    public function renderContent($viewContent){
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    
    public function renderView($view, $params=[]){
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view,$params);
        //interpolacion de variables
        //include_once Application::$ROOT_DIR . "/views/$view.php";

        return str_replace('{{content}}', $viewContent, $layoutContent);

    }
    public function layoutContent(){
        //envia a memoria

        $layout =  Application::$app->controller->layout;

        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        //devuelve contenido que tiene en memoria
        return ob_get_clean();
    }
    public function renderOnlyView($view,$params){

        foreach($params as $key => $value){
            //echo "$key => $value";
            $$key = $value;
        }

        //var_dump($params);

        //envia a memoria
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        //devuelve contenido que tiene en memoria
        return ob_get_clean();
    }    
}