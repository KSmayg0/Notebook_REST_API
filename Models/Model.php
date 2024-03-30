<?php

namespace Models;

use Config\Config;
use Database\Database;
use PDO;
use PDOException;

class Model {

    private Database $database;

    public function __construct(){
        $this->database = new Database();
    }
    # Подключение к бд
    public function getDatabase(): Database {

        return $this->database;
    }
    # Отображение всех записей
    public function getAllLines() {

        $query="SELECT * FROM `Notebook`;";
        $db = $this->getDatabase()->getConnection();
        try {
            $db->beginTransaction();
            $req = $db->prepare($query);
            $req->execute();
            $db->commit();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
       return $req->fetchAll(PDO::FETCH_ASSOC);

    }
    # Отображение одной записи
    public function getLine($line) {

        $query = "SELECT * FROM `Notebook` WHERE id=:id ;";
        $db = $this->getDatabase()->getConnection();
        try {
            $req = $db->prepare($query);

            $req->bindValue(':id', $line, PDO::PARAM_STR_CHAR);
            $req->execute();

            $db->beginTransaction();

            $db->commit();

        } catch (PDOException $e) {
            $db->rollBack();
            echo $e->getMessage();
        }
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    # Удаление записи
    public function deleteLine($line) {

        $query = "DELETE FROM `Notebook` WHERE id=:id ;";
        $db = $this->getDatabase()->getConnection();
        try {
            $req = $db->prepare($query);

            $req->bindValue(':id', $line, PDO::PARAM_STR_CHAR);
            $req->execute();

            $db->beginTransaction();

            $db->commit();

        } catch (PDOException $e) {
            $db->rollBack();
            echo $e->getMessage();
        }
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>