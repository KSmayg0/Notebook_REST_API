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
    public function getDatabase(): Database {

        return $this->database;
    }

    public function getAllLines() {

        $query='SELECT * FROM Notebook;';
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

}

?>