<?php
namespace app\core;

class Router
{
    public Request $request;
    protected array $routes=[];

    public function __construct(\app\core\Request $request ){
        $this->request =$request;
    }

    public function get($path, $callback){
        $this->routes['get'][$path]= $callback;
    }

    public function resolve(){
        // echo '<pre>';
        // var_dump($_SERVER);
        // echo '/<pre>';
        // exit;

        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path]??false;
        if ($callback===false){
            return 'not found';
        }

        if (is_string($callback)){
            return $this->renderView($callback);
        }
        return call_user_func($callback);
        //print_r($this->routes);
        // var_dump($path);
        // var_dump($method);
 
    }

    public function renderView($view){
        include_once __DIR__ . "/../views/$view.php" ;
    }
}