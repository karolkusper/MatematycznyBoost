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


        $homeworkRepo = new HomeworkRepository();
        $homeworks = $homeworkRepo->getHomeworksOfStudent($user['id']);

        $homeworksSolutionsRepo = new HomeworkSolutionsRepository();
        $solutions = $homeworksSolutionsRepo->getHomeworkSolutionsOfStudent($user['id']);

        // Renderuj widok user_view, przekazując dane użytkownika do widoku
        $this->render('user_view', ['user' => $user,'homeworks'=>$homeworks,'solutions'=>$solutions]);
    }

    
     public function teacher_view()
    {
        // Pobierz student_id z parametrów URL
        $studentId = $_GET['student_id'] ?? null;
        // Sprawdź, czy użytkownik jest zalogowany
        $this->isLoggedIn();

        // Odczytaj dane użytkownika bezpośrednio z sesji
        $user = $_SESSION['user'];
        $userRepo = new UserRepository();
        $student = $userRepo->getStudentById($studentId);

        $homeworkRepo = new HomeworkRepository();
        $homework = $homeworkRepo->getHomeworksOfStudent($studentId);

        $homeworksSolutionsRepo = new HomeworkSolutionsRepository();
        $solutions = $homeworksSolutionsRepo->getHomeworkSolutionsOfStudent($studentId);

        // Renderuj widok user_view, przekazując dane użytkownika do widoku
        $this->render('teacher_view', ['user' => $user,'student'=>$student,'homeworks'=>$homework,'solutions'=>$solutions]);
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