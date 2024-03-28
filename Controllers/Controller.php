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
        $json = file_get_contents('php://input');

        $data = json_decode($json,true);
        $line = $this->model->getLine($data['id']);
        debugArrayThenDie($line);
    }

}

?>