<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Homework.php';

class HomeworkSolutionsRepository extends Repository
{

    public function addHomeworkSolution(int $userId, int $homeworkId, string $homeworkTitle, string $homeworkDescription, string $solutionPath): bool
    {
        try {
            $stmt = $this->database->connect()->prepare('INSERT INTO homework_solutions (user_id, homework_id,homework_title, homework_description, solution_path) VALUES (?,?, ?, ?, ?)');
            return $stmt->execute([$userId, $homeworkId, $homeworkTitle, $homeworkDescription, $solutionPath]);
        } catch (PDOException $e) {
            // Obsługa błędów związanych z bazą danych
            die('Database error: ' . $e->getMessage());
        }
    }

    public function getHomeworkSolutionsOfStudent(int $studentId)
    {
        try {
            $result = [];
            $stmt = $this->database->connect()->prepare('SELECT * FROM homework_solutions WHERE user_id=?');
            $stmt->execute([$studentId]);

            //$result = $stmt->fetchAll(PDO::FETCH_CLASS, 'homework');

            $solutions = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($solutions as $solution) {
                $result[$solution['homework_id']] = new HomeworkSolution(
                    $solution['solution_id'],
                    $solution['user_id'],
                    $solution['homework_id'],
                    $solution['homework_title'],
                    $solution['homework_description'],
                    $solution['solution_path'],
                    $solution['grade']
                );

            }
            return $result;

        } catch (PDOException $e) {
            // Obsługa błędów związanych z bazą danych
            die('Database error: ' . $e->getMessage());
        }
    }

    public function getSpecificHomeworkSolutionsOfStudent(int $studentId, string $path)
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM homework_solutions WHERE user_id=? AND solution_path=?');
            $stmt->execute([$studentId, $path]);

            $solution = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($solution) {
                return new HomeworkSolution(
                    $solution['solution_id'],
                    $solution['user_id'],
                    $solution['homework_id'],
                    $solution['homework_title'],
                    $solution['homework_description'],
                    $solution['solution_path'],
                    $solution['grade']
                );
            } else {
                // Zwróć null lub inny kod błędu, jeśli nie znaleziono żadnego wyniku
                return null;
            }
        } catch (PDOException $e) {
            // Obsługa błędów związanych z bazą danych
            die('Database error: ' . $e->getMessage());
        }
    }


    public function gradeSolution($grade, $solutionId)
    {
        try {
            $stmt = $this->database->connect()->prepare('UPDATE homework_solutions SET grade = ? WHERE solution_id = ?');
            return $stmt->execute([$grade, $solutionId]);
        } catch (PDOException $e) {
            // Obsługa błędów związanych z bazą danych
            die('Database error: ' . $e->getMessage());
        }
    }

}
