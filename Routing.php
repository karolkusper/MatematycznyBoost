<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/ErrorController.php';

class Routing{

public static $routes; //tablica asocjacyjna url:odpowiendiCotroller

public static function get($url,$controller)
{
  self::$routes[$url] = $controller;
}

public static function post($url,$controller)
{
    self::$routes[$url] = $controller;
}

public static function run($url)
{
    $action = explode('/',$url)[0];//explode dzieli string na segmenty ktore rozdziela separator
  
    if(!array_key_exists($action,self::$routes))
    {
      $error = new ErrorController();
      return $error->FileNotFound();
    }

    $controller = self::$routes[$action];
    $object = new $controller;

    $action = $action ?: 'index';

    $object->$action();

  }
}