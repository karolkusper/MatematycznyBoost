<?php

require_once 'AppController.php';
const HOMEWORK_UPLOAD_DIRECTORY = '/../public/uploads/homework/';


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



        // Odczytaj zadania z HOMEWORK_UPLOAD_DIRECTORY
        $uploadedHomeworks = $this->getUploadedHomeworks();

        // Renderuj widok teacher_view, przekazując dane użytkownika i zadania
        $this->render('teacher_view', ['user' => $user, 'student' => $student, 'homeworks' => $homework, 'solutions' => $solutions, 'uploadedHomeworks' => $uploadedHomeworks]);
    }

    public function getUploadedHomeworks():array
    {
        $homeworkDirectory = dirname(__DIR__).HomeworkController::HOMEWORK_UPLOAD_DIRECTORY;
        $uploadedHomeworks=[];

        // Sprawdź, czy katalog istnieje
        if(file_exists($homeworkDirectory)&&is_dir($homeworkDirectory))
        {
            // Odczytaj pliki w katalogu
            $files=scandir($homeworkDirectory);

            // Usuń katalogi . i ..
            $files=array_diff($files,['.','..']);

            // Dodaj każdy plik do listy zadań
            foreach ($files as $file)
                {
                    $uploadedHomeworks[]=$file;
                }
        }

        return $uploadedHomeworks;

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