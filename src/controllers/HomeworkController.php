<?php

require_once 'AppController.php';
//require_once __DIR__ .'/../models/User.php';
require_once __DIR__ . '/../models/Homework.php';
require_once __DIR__ . '/../repository/HomeworkRepository.php';

class HomeworkController extends AppController
{
    private $messages = [];
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg', '.pdf', '.txt'];
    const HOMEWORK_UPLOAD_DIRECTORY = '/../public/uploads/homework/';
    const HOMEWORK_SOLUTIONS_UPLOAD_DIRECTORY = '/../public/uploads/homework_solutions/';

    private function isFileUploaded(): bool
    {
        return isset($user['role']) && isset($user['id'])
            && $this->isPost() && is_uploaded_file($_FILES['file']['tmp_name'])
            && $this->validate($_FILES['file']);
    }

    public function addExercise()
    {
        $user = $_SESSION['user'];
        if (!$this->isFileUploaded()) {
            // Dodaj obsługę przypadku, gdy zmienne sesji nie są ustawione
//            $this->render('teacher_view', ['messages' => ['Session data missing or file not uploaded']]);
//            return;
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/teacher_view?student_id=".$_POST['student_id']);
        }

        $path = $user["role"] === "student" ? self::HOMEWORK_SOLUTIONS_UPLOAD_DIRECTORY : self::HOMEWORK_UPLOAD_DIRECTORY;


        //dodac sprawdzenie czy takie zadanie juz nie jest wstawione

        move_uploaded_file(
            $_FILES['file']['tmp_name'],
            dirname(__DIR__) . $path . $_FILES['file']['name']
        );

        if ($user['role'] === "teacher") {

            $taskPath = '/public/uploads/homework/' . $_FILES['file']['name'];;

            $homeworkRepo = new HomeworkRepository();

            // Odczytaj student_id z danych POST
            $assignTo = $_POST['student_id'] ?? null;
            $description = $_POST['description'];

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

        return $this->render('teacher_view', ['messages' => $this->messages]);


        //return $this->render('teacher_view',['messages'=>$this->messages]);
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