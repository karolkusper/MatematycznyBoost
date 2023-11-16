<?php

require_once 'AppController.php';

class DefaultController extends AppController
{
    public function index()
    {
        //todo display login.html
       // die("index method");
       $this->render('login');
    }

    public function register()
    {
        //todo display register.html
       // die("register method");
       $this->render('register');
    }

    public function user_view()
    {
        $this->render('user_view');
    }
    
     public function teacher_view()
    {
        $this->render('teacher_view');
    }
     public function users()
    {
        $this->render('users');
    }
}