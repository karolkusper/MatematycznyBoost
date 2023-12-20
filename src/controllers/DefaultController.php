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
        $this->isLoggedIn();

        // Odczytaj dane użytkownika bezpośrednio z sesji
        $user = $_SESSION['user'];

        // Renderuj widok user_view, przekazując dane użytkownika do widoku
        $this->render('user_view', ['user' => $user]);
    }

    
     public function teacher_view()
    {
        // Sprawdź, czy użytkownik jest zalogowany
        $this->isLoggedIn();

        // Odczytaj dane użytkownika bezpośrednio z sesji
        $user = $_SESSION['user'];

        // Renderuj widok user_view, przekazując dane użytkownika do widoku
        $this->render('teacher_view', ['user' => $user]);
    }
     public function students()
    {
        // Sprawdź, czy użytkownik jest zalogowany
        $this->isLoggedIn();

        // Odczytaj dane użytkownika bezpośrednio z sesji
        $user = $_SESSION['user'];
        $userRepo = new UserRepository();

        $this->render('students',['user' => $user,"students"=>$userRepo->getStudents()]);
    }
}