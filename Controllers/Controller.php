<?php

namespace Controllers;

use Models\Model;

class Controller {

    private Model $model;
    
    public function __construct()
    {
        $this->model = new Model();
    }

    public function getAllLines(): void {
        $array = $this->model->getAllLines();
        debugArrayThenDie($array);
    }

    public function getLine(): void {
        $line = $this->model->getLine($_GET['id']);
        debugArrayThenDie($line);
    }

    public function getLineByPost(): void {
        $line = $this->model->getLine($this->getInput()['id']);
        debugArrayThenDie($line);
    }

    public function deleteLine(): void {
        $line = $this->model->deleteLine($this->getInput()['id']);
        debugArrayThenDie($line);
    }

    private function getInput() {
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);

        return $data;
    }

}

?>