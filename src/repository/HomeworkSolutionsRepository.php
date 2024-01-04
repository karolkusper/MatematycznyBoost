<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Homework.php';

class HomeworkSolutionsRepository extends Repository
{

    public function addHomeworkSolution(int $userId,int $homeworkId,String $homeworkTitle,String $homeworkDescription,String $solutionPath): bool
    {
        try {
            $stmt = $this->database->connect()->prepare('INSERT INTO homework_solutions (user_id, homework_id,homework_title, homework_description, solution_path) VALUES (?,?, ?, ?, ?)');
            return $stmt->execute([$userId,$homeworkId, $homeworkTitle, $homeworkDescription, $solutionPath]);
        } catch (PDOException $e) {
            // Obsługa błędów związanych z bazą danych
            die('Database error: ' . $e->getMessage());
        }
    }

    public function getHomeworkSolutionsOfStudent(int $studentId)
    {
        try{
            $result=[];
            $stmt = $this->database->connect()->prepare('SELECT * FROM homework_solutions WHERE user_id=?');
            $stmt->execute([$studentId]);

            //$result = $stmt->fetchAll(PDO::FETCH_CLASS, 'homework');

            $homeworks = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($homeworks as $homework)
            {
                $result[]=new HomeworkSolution(
                    $homework['solution_id'],
                    $homework['user_id'],
                    $homework['homework_id'],
                    $homework['homework_title'],
                    $homework['homework_description'],
                    $homework['solution_path']
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


}
