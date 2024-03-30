<?php

namespace Controllers;

use Models\Model;

class Controller {

    private Model $model;
    
    public function __construct()
    {
        $this->model = new Model();
    }
    # Функция для сбора всех записей
    public function getAllLines(): void {
        $array = $this->model->getAllLines();
        debugArrayThenDie($array);
    }
    # Функция для выборки одной записи с помощью GET
    public function getLine(): void {
        $line = $this->model->getLine($_GET['id']);
        debugArrayThenDie($line);
    }
    # Функция для выборки одной записи с помощью POST
    public function getLineByPost(): void {
        $line = $this->model->getLine($this->getInput()['id']);
        debugArrayThenDie($line);
    }
    # Функция для удаления одной записи
    public function deleteLine(): void {
        $line = $this->model->deleteLine($this->getInput()['id']);
        debugArrayThenDie($line);
    }
    # Функция для получения json
    private function getInput() {
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);

        return $data;
    }

}

?>