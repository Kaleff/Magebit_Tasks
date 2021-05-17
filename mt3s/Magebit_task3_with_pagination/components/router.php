<?php


class Router
{
    protected $routes;
    protected $params;
    public function __construct()
    {
        $routesArray = include ROOT . "/config/routes.php";
        foreach ($routesArray as $rKey => $rValue) {
            $this->add($rKey, $rValue);
        }
    }

    public function add($route, $params)
    {
        $route = "@" . $route . "@";
        $this->routes[$route] = $params;
    }
    public function match()
    {
        $url = trim($_SERVER["REQUEST_URI"], "/");
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }
    public function run()
    {
        if($this->match() ){
            $controllerPath = ROOT . "/controllers/".ucfirst($this->params["controller"]) . "Controller.php";
            $ControllerName = ucfirst($this->params["controller"]) . "Controller";
            // echo $controllerPath. " " .$this->params["action"] . "<br>";
            if (file_exists($controllerPath)) {
                $controllerAction = $this->params['action'] . "Action";
                if (method_exists($ControllerName, $controllerAction)) {
                    $controller = new $ControllerName($this->params);
                    $controller -> $controllerAction();
                } else {
                    echo "Method doesn't exist";
                    View::errorCode(404);
                }
            } else {
                echo "File doesn't exist";
                View::errorCode(404);
            }
        } else {
            echo "No match";
            View::errorCode(404);
        }
    }
}