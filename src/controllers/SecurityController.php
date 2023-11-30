<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';

class SecurityController extends AppController {

    public function login()
    {
        //nie ma jeszcze bazy danych wiec dodajemy uzytkownika na sztywno
        $user = new User("dwight.shrute@theoffice.com","beets","Dwight","Schrute");

        if(!$this->isPost())
        {
            $this->render("login");
        }
        $email = $_POST['email'];
        $password = $_POST['password'];

        if($user->getEmail()!==$email)
        {
            return $this->render('login',['messages'=>['User with this email does not exist!']]);
        }
        if(!password_verify($password,$user->getHashedPassword()))
        {
            return $this->render('login',["messages"=>['Wrong password!']]);
        }

        //return $this->render('user_view');
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/user_view");
    }

}