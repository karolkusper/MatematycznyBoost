<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Homework.php';

class HomeworkRepository extends Repository
{

    public function addHomework(int $teacherId,int $assignTo,String $title,String $description,String $taskPath): bool
    {
        try {
            $stmt = $this->database->connect()->prepare('INSERT INTO homework (teacher_id, assigned_to,title, description, task_path) VALUES (?,?, ?, ?, ?)');
            return $stmt->execute([$teacherId,$assignTo, $title, $description, $taskPath]);
        } catch (PDOException $e) {
            // Obsługa błędów związanych z bazą danych
            die('Database error: ' . $e->getMessage());
        }
    }

    public function getHomeworksOfStudent(int $studentId)
    {
        try{
            $result=[];
            $stmt = $this->database->connect()->prepare('SELECT * FROM homework WHERE assigned_to=?');
            $stmt->execute([$studentId]);

            //$result = $stmt->fetchAll(PDO::FETCH_CLASS, 'homework');

            $homeworks = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($homeworks as $homework)
            {
                $result[]=new Homework(
                    $homework['homework_id'],
                    $homework['teacher_id'],
                    $homework['assigned_to'],
                    $homework['title'],
                    $homework['description'],
                    $homework['task_path']
                );

            }
            // TODO: add close method
            return $result;

        }
        catch(PDOException $e)
        {
            // Obsługa błędów związanych z bazą danych
            die('Database error: ' . $e->getMessage());
        }
    }



    public function getSpecificHomeworkOfStudent(int $studentId,String $path)
    {
        try{
            $result=[];
            $stmt = $this->database->connect()->prepare('SELECT * FROM homework WHERE assigned_to=? AND task_path=?');
            $stmt->execute([$studentId,$path]);

            //$result = $stmt->fetchAll(PDO::FETCH_CLASS, 'homework');

            $homeworks = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($homeworks as $homework)
            {
                $result[]=new Homework(
                    $homework['homework_id'],
                    $homework['teacher_id'],
                    $homework['assigned_to'],
                    $homework['title'],
                    $homework['description'],
                    $homework['task_path']
                );

            }
            // TODO: add close method
            return $result;

        }
        catch(PDOException $e)
        {
            // Obsługa błędów związanych z bazą danych
            die('Database error: ' . $e->getMessage());
        }
    }


//    public function getHomeworkByTitleOrDesc(string $searchString)
//    {
//        $searchString = '%'.strtolower($searchString).'%';
//        $stmt=$this->database->connect()->prepare('SELECT * FROM homework WHERE LOWER(title) LIKE ? OR LOWER(description) LIKE ?');
////        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
//        $stmt->execute([$searchString]);
//
//        return $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//    }


}
