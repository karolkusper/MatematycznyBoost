<?php

require_once 'AppController.php';
//require_once __DIR__ .'/../models/User.php';
require_once __DIR__ .'/../models/Exercise.php';
class ExerciseController extends AppController
{
   private $messages = [];
   const MAX_FILE_SIZE = 1024*1024;
   const SUPPORTED_TYPES = ['image/png','image/jpeg','.pdf','.txt'];
   const UPLOAD_DIRECTORY = '/../public/uploads/';
    public function addExercise()
    {
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file']))
        {
            //to do
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            //$exercise = new Exercise($_POST('title'),$_POST('description'),$_FILES['file']['name']);

//            return $this->render('teacher_view',['messages'=>$this->messages,'exercise'=>$exercise]);
            return $this->render('teacher_view',['messages'=>$this->messages]);
        }


        return $this->render('teacher_view',['messages'=>$this->messages]);
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