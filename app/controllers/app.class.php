<?php

require_once('db.class.php');
require_once('template.class.php');

class App
{

    private $db;
    private $model;
    private $args;

    public function __construct()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uriParts = explode('/', $uri);
        array_shift($uriParts);

        for ($i = 1; $i < count($uriParts); $i++) {
            $this->args[] = $uriParts[$i];
        }

        /*$this->connectDB();*/
        $this->loadModel($uriParts[0]);
    }

    /*private function connectDB() {
    $this->db = new DB();
  }*/

    private function loadModel($modelName)
    {
        if ($modelName != '') {
            require_once("models/" . $modelName . ".php");
            $modelName = ucfirst($modelName);

            $this->model = new $modelName($this->db);
            $this->callMethod($this->model);
        } else {
            $this->render(["child" => new Template("views/login.html", [])]);
        }
    }

    private function callMethod($model)
    {
        $template = "";
        if (!isset($this->args[0])) {
            $template = $model->index();
        } else {
            $template = $model->show($this->args[0]);
        }

        $this->render($template);
    }

    private function render($data)
    {
        $view = new Template("views/app.html", $data);
        echo $view;
    }
}
