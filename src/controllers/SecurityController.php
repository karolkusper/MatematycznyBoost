<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';

class SecurityController extends AppController {

    //tymaczsowa niezaszyfrowana tablica uzytkownikow(potem bedzie baza danych)
    private static $users = [];

    public function addUser(string $email, string $password, string $username)
    {
        $user = new User($email, $password, $username);
        $_SESSION['users'][$email] = $user;
        //var_dump($_SESSION['users']); // Add this line for debugging
    }
    public function login()
    {
        //nie ma jeszcze bazy danych wiec dodajemy uzytkownika na sztywno
        //$user = new User("dwight.shrute@theoffice.com","beets","Dwight","Schrute");

        if(!$this->isPost())
        {
            $this->render("login");
        }
        $email = $_POST['email'];
        $password = $_POST['password'];

//        if($user->getEmail()!==$email)
//        {
//            return $this->render('login',['messages'=>['User with this email does not exist!']]);
//        }
//        if(!password_verify($password,$user->getHashedPassword()))
//        {
//            return $this->render('login',["messages"=>['Wrong password!']]);
//        }

//        $userFound = false;
//        foreach (self::$users as $storedUser) {
//            if ($storedUser->getEmail() === $email) {
//                $userFound = true;
//                if (!password_verify($password, $storedUser->getHashedPassword())) {
//                    return $this->render('login', ["messages" => ['Wrong password!']]);
//                }
//                break;
//            }
//        }
//        var_dump(self::$users);
//        if(!array_key_exists($email,self::$users))
//        {
//            return $this->render('login',['messages'=>['User with this email does not exist!']]);
//
//        }
//
//        if(!password_verify($password,self::$users[$email]->getHashedPassword()))
//        {
//
//            return $this->render('login',["messages"=>['Wrong password!']]);
//        }
        //var_dump($_SESSION['users']); // Add this line for debugging

        if (!array_key_exists($email, $_SESSION['users'])) {
            return $this->render('login', ['messages' => ['User with this email does not exist!']]);
        }

        if (!password_verify($password, $_SESSION['users'][$email]->getHashedPassword())) {
            return $this->render('login', ["messages" => ['Wrong password!']]);
        }

        //return $this->render('user_view');
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/user_view");
    }

    public function register()
    {
        if (!$this->isPost()) {
            $this->render("register");
        }

        $username = isset($_POST['username']) ? $_POST['username'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        $confirmed = isset($_POST['confirmed']) ? $_POST['confirmed'] : null;

        if ($username === null || $email === null || $password === null || $confirmed === null) {
            // Handle the case where one or more form fields are not set
            return $this->render('register', ['messages' => ["All form fields are required"]]);
        }

        if ($password !== $confirmed) {
            return $this->render('register', ['messages' => ["Confirmed password is different than the first one"]]);
        }

        $this->addUser($email, $password, $username);

        return $this->render('login');
    }

}