<?php

require_once 'AppController.php';
require_once __DIR__."/../models/User.php";
require_once __DIR__.'/../repository/UserRepository.php';


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
        if (!$this->isPost()) {
            $this->render("login");
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $userRepository = new UserRepository();
        $loggedInUser = $userRepository->getUserByEmail($email);

        if (!$loggedInUser) {
            return $this->render('login', ['messages' => ['User with this email does not exist!']]);
        }

        if (!password_verify($password, $loggedInUser->getHashedPassword())) {
            return $this->render('login', ["messages" => ['Wrong password!']]);
        }

        $_SESSION['user'] = $loggedInUser;

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

        $userRepository = new UserRepository();
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $success = $userRepository->addUser($email, $hashedPassword, $username);

        if (!$success) {
            return $this->render('register', ['messages' => ["Error adding user to the database"]]);
        }

        return $this->render('login');
    }

}