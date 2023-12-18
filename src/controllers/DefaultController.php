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
        // Sprawdź, czy użytkownik jest zalogowany
        if (!isset($_SESSION['user'])) {
            // Jeśli użytkownik nie jest zalogowany, przekieruj na stronę logowania
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
            exit();
        }

        // Odczytaj dane użytkownika bezpośrednio z sesji
        $user = $_SESSION['user'];

        // Renderuj widok user_view, przekazując dane użytkownika do widoku
        $this->render('user_view', ['user' => $user]);
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