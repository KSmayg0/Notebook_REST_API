<?php

namespace Database;

use Config\Config;
use PDO;
use PDOException;

class Database {

    public function __construct() {

    }
    # Подключение к базе данных
    public function getConnection() {

        try{
            $DB = new PDO('mysql:host='.Config::$DB_SERVER.';dbname='.Config::$DB_NAME, Config::$DB_USERNAME, Config::$DB_PASSWORD);
            
            $DB->exec("set names utf8");
            return $DB;
        } catch(PDOException $e) {
            print "Error: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}

?>