<?php


class View
{
    public $task;
    public $path;
    public $data;
    public function __construct($task)
    {
        $this->task = $task;
        $this->path = $task["controller"] . "/" . $task['action'];
        // echo $this->path."<br>";
    }

    public function render($data)
    {
        $this->data = $data;
        if (file_exists(ROOT . "/view/" . $this->path . ".php")) {
            include_once ROOT . "/view/" . $this->path . ".php";
        } else {
            $this::errorCode(404);
        }
    }

    public function redirect($url)
    {
        header("Location: ".$url);
        die();
    }

    public static function errorCode($code)
    {
        http_response_code($code);
        $path = "view/errors/".$code.".php";
        if (file_exists($path)) {
            include_once $path;
        }
        die();
    }
}