<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Homework.php';

class HomeworkRepository extends Repository
{

    public function addHomework(int $teacherId,String $title,String $description,String $taskPath): bool
    {
        try {
            $stmt = $this->database->connect()->prepare('INSERT INTO homework (teacher_id, title, description, task_path) VALUES (?, ?, ?, ?)');
            $result = $stmt->execute([$teacherId, $title, $description, $taskPath]);

            return $result;
        } catch (PDOException $e) {
            // Obsługa błędów związanych z bazą danych
            die('Database error: ' . $e->getMessage());
        }
    }
}
