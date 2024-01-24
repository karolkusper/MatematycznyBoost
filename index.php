<?php
session_start(); // Start the session
require 'src/models/User.php';
require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'],'/'); //_SERVER to zmienna glopalna ktora zawiera sciezke z paska url
$path = parse_url($path,PHP_URL_PATH);


Routing::get('index',"DefaultController");
Routing::get('user_view',"DefaultController");
Routing::get('teacher_view',"DefaultController");
Routing::get('myProfile',"DefaultController");
Routing::get('students',"DefaultController");
Routing::get('FileNotFound',"ErrorController");

Routing::get('logout', 'SecurityController');

Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('addExercise', 'HomeworkController');
Routing::post('gradeSolution', 'HomeworkController');
Routing::post('changeProfilePicture', 'HomeworkController');
//Routing::post('search','HomeworkController');
Routing::post('alterProfile','DefaultController');
Routing::post('updateSession','DefaultController');



Routing::run($path);


