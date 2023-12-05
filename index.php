<?php
require 'src/models/User.php';
require 'Routing.php';
session_start(); // Start the session


$path = trim($_SERVER['REQUEST_URI'],'/'); //_SERVER to zmienna glopalna ktora zawiera sciezke z paska url
$path = parse_url($path,PHP_URL_PATH);


Routing::get('index',"DefaultController");
//Routing::get('register',"DefaultController");
Routing::get('user_view',"DefaultController");
Routing::get('teacher_view',"DefaultController");
Routing::get('users',"DefaultController");
Routing::get('FileNotFound',"ErrorController");
Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('addExercise', 'ExerciseController');

Routing::run($path);


