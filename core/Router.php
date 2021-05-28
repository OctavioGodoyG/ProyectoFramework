<?php
namespace app\core;

class Router
{
    public Request $request;
    public Response $response;

    protected array $routes=[];

    public function __construct(Request $request, Response $response){
        $this->request =$request;
        $this->respose =$response;
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

        echo "<pre>";
        echo 'De Router.php';
        echo "</pre>";
        echo "<pre>";
        echo '$path:';
        var_dump($path);
        echo '$method:';
        var_dump($method);
        //echo '$callback:'; . $callback ;
        echo "</pre>";

        if ($callback===false){
            // Application::$app->response->setStatusCode(404);
            $this->response->setStatusCode(404);
            // return 'not found';
            return $this->renderView('_404');
        }

        if (is_string($callback)){
            return $this->renderView($callback);
        }
        if(is_array($callback)){
            
            //$bla = new app\controllers\SiteController();
            //$bla = $callback[0]();
            $callback[0] = new $callback[0]();
            //var_dump($callback);
            //exit;
            
        }

        return call_user_func($callback);
        //print_r($this->routes);
        // var_dump($path);
        // var_dump($method);
    }

    public function renderContent($viewContent){
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent());
    }
    
    public function renderView($view){
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);
        //interpolacion de variables
        include_once Application::$ROOT_DIR . "/views/$view.php";

        return str_replace('{{content}}', $viewContent, $layoutContent);

    }
    public function layoutContent(){
        //envia a memoria
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/main.php";
        //devuelve contenido que tiene en memoria
        return ob_get_clean();
    }
    public function renderOnlyView($view){
        //envia a memoria
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        //devuelve contenido que tiene en memoria
        return ob_get_clean();
    }    
}