<?php

require_once 'AppController.php';
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../../Routing.php';


class SecurityController extends AppController
{

    public function login()
    {
        if (!$this->isPost()) {
            $this->render("login");
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $userRepository = new userRepository();
        $loggedInUser = $userRepository->getUserByEmail($email);

        if (!$loggedInUser) {
            return $this->render('login', ['messages' => ['User with this email does not exist!']]);
        }

        if (!password_verify($password, $loggedInUser->getPassword())) {
            return $this->render('login', ["messages" => ['Wrong password!']]);
        }

        // Utwórz sesję użytkownika
        $_SESSION['user'] = [
            'id' => $loggedInUser->getId(),
            'email' => $loggedInUser->getEmail(),
            'username' => $loggedInUser->getUsername(),
            'role' => $loggedInUser->getRole()
        ];


        if ($loggedInUser->getRole() === "student") {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/user_view");
        } else {
            return $this->render('students', ["user" => $_SESSION['user'], "students" => $userRepository->getStudents()]);
        }

    }


    public function register()
    {
        if (!$this->isPost()) {
            return $this->render("register");
        }

        $username = isset($_POST['username']) ? trim($_POST['username']) : null;
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $password = isset($_POST['password']) ? trim($_POST['password']) : null;
        $confirmed = isset($_POST['confirmed']) ? trim($_POST['confirmed']) : null;

        if (empty($username) || empty($email) || empty($password) || empty($confirmed)) {
            // Handle the case where one or more form fields are empty
            return $this->render('register', ['messages' => ["All form fields are required"]]);
        }

        if ($password !== $confirmed) {
            return $this->render('register', ['messages' => ["Confirmed password is different than the first one"]]);
        }

        //check if user with this email already exists
        $userRepository = new userRepository();
        $userExists = $userRepository->getUserByEmail($email);
        if ($userExists) {
            return $this->render('register', ['messages' => ["User with this email already exists!"]]);
        }


        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $success = $userRepository->addUser($email, $hashedPassword, $username);

        if (!$success) {
            return $this->render('register', ['messages' => ["Error adding user to the database"]]);
        }

        return $this->render('login');
    }


    public function logout()
    {
        // Zakończ sesję
        session_unset();
        session_destroy();

        // Przekieruj na stronę logowania
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/index");
        exit();
    }

}