<?php

require_once 'AppController.php';
//require_once __DIR__ .'/../models/User.php';
require_once __DIR__ . '/../models/Homework.php';
require_once __DIR__ . '/../models/HomeworkSolution.php';
require_once __DIR__ . '/../repository/HomeworkRepository.php';
require_once __DIR__ . '/../repository/HomeworkSolutionsRepository.php';

class HomeworkController extends AppController
{
    private $messages = [];
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg', '.pdf', '.txt'];
    const HOMEWORK_UPLOAD_DIRECTORY = '/../public/uploads/homework/';
    const HOMEWORK_SOLUTIONS_UPLOAD_DIRECTORY = '/../public/uploads/homework_solutions/';

    private function isFileUploaded(): bool
    {
        return  $this->isPost() && is_uploaded_file($_FILES['file']['tmp_name'])
            && $this->validate($_FILES['file']);

        //isset($user['role']) && isset($user['id'])
        //            &&
    }

    public function addExercise()
    {
        $user = $_SESSION['user'];
        if (!$this->isFileUploaded()) {
            // Dodaj obsługę przypadku, gdy zmienne sesji nie są ustawione
//            $this->render('teacher_view', ['messages' => ['Session data missing or file not uploaded']]);
//            return;
            if($user['role']==="student")
            {
                return $this->render('user_view', ['messages' => ['Session data missing or file not uploaded']]);
            }
            else{
                echo "if file uploaded zwrocil blad";
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/teacher_view?student_id=".$_POST['student_id']);
                //return $this->render('teacher_view', ['messages' => ['Session data missing or file not uploaded']]);
            }

        }

        $path = $user["role"] === "student" ? self::HOMEWORK_SOLUTIONS_UPLOAD_DIRECTORY : self::HOMEWORK_UPLOAD_DIRECTORY;


        //dodac sprawdzenie czy takie zadanie juz nie jest wstawione

        if(!file_exists(dirname(__DIR__) . $path . $_FILES['file']['name']))
        {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__) . $path . $_FILES['file']['name']
            );
        }


        if ($user['role'] === "teacher") {

            $taskPath = '/public/uploads/homework/' . $_FILES['file']['name'];;

            $homeworkRepo = new HomeworkRepository();

            // Odczytaj student_id z danych POST
            $assignTo = $_POST['student_id'] ?? null;
            $description = $_POST['description'];

            $homeworkAlreadyExist=$homeworkRepo->getSpecificHomeworkOfStudent($assignTo,$taskPath);
            if(!$homeworkAlreadyExist)
            {
                $success = $homeworkRepo->addHomework(
                    (int)$user['id'],
                    (int)$assignTo,
                    $_POST['title'],
                    $description,
                    $taskPath
                );

                if (!$success) {
                    return $this->render('teacher_view', ['messages' => ["Error adding exercise to the database"]]);
                }

                // Przekieruj do teacher_view w DefaultController
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/teacher_view?student_id=$assignTo");
            }
            else{
                $message = "Zadanie o tym pliku dla tego ucznia juz istnieje w bazie";
                // Przekieruj do teacher_view w DefaultController
                $url = "http://$_SERVER[HTTP_HOST]";
                //header("Location: {$url}/teacher_view?student_id={$assignTo}&message={$message})");
                header("Location: {$url}/teacher_view?student_id={$assignTo}&message=" . urlencode($message));
            }


        }
        else{


            $solutionPath = '/public/uploads/homework_solutions/' . $_FILES['file']['name'];;

            $homeworkSolutionRepo = new HomeworkSolutionsRepository();

            $homeworkSolutionAlreadyExist=$homeworkSolutionRepo->getSpecificHomeworkSolutionsOfStudent((int)$user['id'], $solutionPath);

            if(!$homeworkSolutionAlreadyExist)
            {
                $success = $homeworkSolutionRepo->addHomeworkSolution(
                    (int)$user['id'],
                    (int)$_POST['homework_id'],
                    $_POST['title'],
                    $_POST['description'],
                    $solutionPath
                );

                if (!$success) {
                    return $this->render('user_view', ['messages' => ["Error adding solutie to the database"]]);
                }

                // Przekieruj do teacher_view w DefaultController
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/user_view");
            }
            else{
                $message = "Rozwiązanie o takim pliku zostalo juz umieszczone w bazie w zadaniu: ".$homeworkSolutionAlreadyExist->getHomeworkTitle();
                // Przekieruj do teacher_view w DefaultController
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/user_view?message=" . urlencode($message));
            }
        }

    }

    public function gradeSolution()
    {
        // Pobierz dane oceny z żądania POST
        $solutionId = $_POST['solution_id'];
        $grade = $_POST['grade'];

        // Tutaj wykonaj odpowiednie operacje, np. zapisz ocenę w bazie danych
        // ...
        $homeworkSolutionRepo = new HomeworkSolutionsRepository();
        $homeworkSolutionRepo->gradeSolution($grade,$solutionId);


        // Przekieruj użytkownika z powrotem do widoku zadań
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/teacher_view?student_id=".$_POST['student_id']);
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = "File is too large!";
            return false;
        }
        if (!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = "That type is not supported!";
            return false;
        }
        return true;
    }
}