<?php


abstract class Controller
{
    public $task;
    public $view;
    public $model;
    public function __construct($task)
    {
        $this->task = $task;
        $this->view = new View($task);
        $this->model = $this->loadModel($task['controller']);
    }
    public function loadModel($modelName)
    {
        $modelName = ucfirst($modelName);
        $path = ROOT . "/models/" . $modelName . ".php";
        if(file_exists($path)) {
            return new $modelName;
        }
        else return false;
    }
}