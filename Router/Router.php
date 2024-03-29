<?php

namespace Router;
use Config\Config;

class Router {

static array $routes = [];

static public function generateRoutes(): void {
    $method = $_SERVER['REQUEST_METHOD'];
    $json = file_get_contents('php://input');

    $data = json_decode($json,true);
    # Метод для отображения списка всех записей (POST и GET)
    self::addRoute('/api/v1/notebook/','Controller@getAllLines');
    
    # Метод для отображения одной записи из списка (POST и GET)
    if($method=="GET") {
        self::addRoute('/api/v1/notebook?id='.$_GET['id'],'Controller@getLine');
    }
    if($method=="POST") {
        self::addRoute('/api/v1/notebook/'.$data['id'],'Controller@getLineByPost');
    }

    # Метод для удаления записи из списка (DELETE запрос)
    if($method=="DELETE") {
        self::addRoute('/api/v1/notebook/'.$data['id'],'Controller@deleteLine');
    }

}

    # Функция для добавления пути в массив
    static public function addRoute($uri, $move): void {

        self::$routes[] = array(
            'uri'=>$uri,
            'move'=>$move
        );
    }

    static function searchInRoutes($uri): array {

        $checkArray = array();
        $checkArray[0]=array(
            'check'=>false,
        );

        foreach (self::$routes as $key => $route) {

            if($route['uri'] == $uri) {
                $checkArray[0] = array(
                    'check'=>true,
                    'uri'=>$uri,
                    'move'=>$route['move']
                );

                return $checkArray;
            }
        }
        return $checkArray;
    }

    static public function get($uri): void {

        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        $checkArray = self::searchInRoutes($uri);
        if($checkArray[0]['check']) {

            $controllerPath = 'Controllers';
            
                $controller = explode('@', $checkArray[0]['move'])[0];
                $method = explode('@', $checkArray[0]['move'])[1];

                $controller = $controllerPath.'\\'.$controller;

                $objectController = new $controller;

                $objectController->$method();
        }
    }
}
?>