<?php


class MainController extends Controller
{
    protected $verResult = null;
    public function indexAction()
    {
        if(isset($_POST['email']))
        {
            $this->verResult = $this->model->verifyEmail($_POST['email']);
        }
        $this->view->render($this->verResult);
    }
    public function listAction()
    {
        $result = $this->model->getDatabaseinfo();
        $this->view->render($result);
        /*print_r($_GET);
        print_r($_SERVER["REQUEST_URI"]);
        print_r($_POST); */
    }
    public function printAction()
    {
        //print_r($_POST);
        $post = $_POST;
        $this->model->printFile($post);
    }
}