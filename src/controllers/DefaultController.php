<?php

require_once 'AppController.php';

class DefaultController extends AppController
{
    public function index()
    {
       $this->render('login');
    }

    public function register()
    {

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