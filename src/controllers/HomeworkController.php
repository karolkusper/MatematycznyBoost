<?php

require_once 'AppController.php';
//require_once __DIR__ .'/../models/User.php';
require_once __DIR__ . '/../models/Homework.php';
require_once __DIR__.'/../repository/HomeworkRepository.php';
class HomeworkController extends AppController
{
   private $messages = [];
   const MAX_FILE_SIZE = 1024*1024;
   const SUPPORTED_TYPES = ['image/png','image/jpeg','.pdf','.txt'];
    const HOMEWORK_UPLOAD_DIRECTORY = '/../public/uploads/homework/';
    const HOMEWORK_SOLUTIONS_UPLOAD_DIRECTORY = '/../public/uploads/homework_solutions/';
    public function addExercise()
    {
        $user=$_SESSION['user'];
        if(isset($user['role']) && isset($user['id']) && $this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file']))
        {


            if($user['role']==="student")
            {
                move_uploaded_file(
                    $_FILES['file']['tmp_name'],
                    dirname(__DIR__).self::HOMEWORK_SOLUTIONS_UPLOAD_DIRECTORY.$_FILES['file']['name']
                );
            }
            else{
                move_uploaded_file(
                    $_FILES['file']['tmp_name'],
                    dirname(__DIR__).self::HOMEWORK_UPLOAD_DIRECTORY.$_FILES['file']['name']
                );

                $taskPath='/app/public/uploads/homework/'.$_FILES['file']['name'];;

                $homeworkRepo = new HomeworkRepository();

                $teacherId = (int)$user['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];

                $success = $homeworkRepo->addHomework($teacherId, $title, $description, $taskPath);

                if (!$success) {
                    return $this->render('teacher_view', ['messages' => ["Error adding user to the database"]]);
                }

                return $this->render('teacher_view');
            }

            return $this->render('teacher_view',['messages'=>$this->messages]);
        }
        else{
            // Dodaj obsługę przypadku, gdy zmienne sesji nie są ustawione
            $this->render('teacher_view', ['messages' => ['Session data missing']]);
        }

        //return $this->render('teacher_view',['messages'=>$this->messages]);
    }

    private function validate(array $file):bool
    {
        if($file['size']>self::MAX_FILE_SIZE)
        {
            $this->messages[]="File is too large!";
            return false;
        }
        if(!isset($file['type']) && !in_array($file['type'],self::SUPPORTED_TYPES))
        {
            $this->messages[]="That type is not supported!";
            return false;
        }
        return true;
    }
}