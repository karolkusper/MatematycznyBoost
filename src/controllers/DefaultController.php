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

        // Odczytaj zadania z HOMEWORK_UPLOAD_DIRECTORY
        $uploadedSolutions = $this->getUploadedSolutions();

        // Renderuj widok user_view, przekazując dane użytkownika do widoku
        $this->render('user_view', ['user' => $user, 'homeworks' => $homeworks, 'solutions' => $solutions, 'uploadedSolutions' => $uploadedSolutions]);
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

    public function getUploadedHomeworks(): array
    {
        $homeworkDirectory = dirname(__DIR__) . FilesController::HOMEWORK_UPLOAD_DIRECTORY;
        $uploadedHomeworks = [];

        // Sprawdź, czy katalog istnieje
        if (file_exists($homeworkDirectory) && is_dir($homeworkDirectory)) {
            // Odczytaj pliki w katalogu
            $files = scandir($homeworkDirectory);

            // Usuń katalogi . i ..
            $files = array_diff($files, ['.', '..']);

            // Dodaj każdy plik do listy zadań
            foreach ($files as $file) {
                $uploadedHomeworks[] = $file;
            }
        }

        return $uploadedHomeworks;

    }

    public function getUploadedSolutions(): array
    {
        $homeworkSolutionDirectory = dirname(__DIR__) . FilesController::HOMEWORK_SOLUTIONS_UPLOAD_DIRECTORY;
        $uploadedSolutions = [];

        // Sprawdź, czy katalog istnieje
        if (file_exists($homeworkSolutionDirectory) && is_dir($homeworkSolutionDirectory)) {
            // Odczytaj pliki w katalogu
            $files = scandir($homeworkSolutionDirectory);

            // Usuń katalogi . i ..
            $files = array_diff($files, ['.', '..']);

            // Dodaj każdy plik do listy zadań
            foreach ($files as $file) {
                $uploadedSolutions[] = $file;
            }
        }

        return $uploadedSolutions;

    }

    public function students()
    {
        // Sprawdź, czy użytkownik jest zalogowany
        $this->isLoggedIn();

        // Odczytaj dane użytkownika bezpośrednio z sesji
        $user = $_SESSION['user'];
        $userRepo = new UserRepository();

        $this->render('students', ['user' => $user, "students" => $userRepo->getStudents()]);
    }
}