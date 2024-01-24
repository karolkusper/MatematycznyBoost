<?php

// UserRepository.php
require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository
{
    public function getUserByEmail(string $email): ?User
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM users WHERE email = ?');
            $stmt->execute([$email]);
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$userData) {
                return null; // Użytkownik o podanym adresie email nie istnieje
            }

            return new User(
                $userData['user_id'],
                $userData['email'],
                $userData['password_hash'],
                $userData['username'],
                $userData['role']
            // Dodaj inne pola, jeśli są dostępne w tabeli users
            );
        } catch (PDOException $e) {
            // Obsługa błędów związanych z bazą danych
            die('Database error: ' . $e->getMessage());
        }
    }


    public function addUser(string $email, string $hashedPassword, string $username): bool
    {
        try {
            $stmt = $this->database->connect()->prepare('INSERT INTO users (email, password_hash, username, role) VALUES (?, ?, ?, ?)');
            $result = $stmt->execute([$email, $hashedPassword, $username, 'student']);

            return $result;
        } catch (PDOException $e) {
            // Obsługa błędów związanych z bazą danych
            die('Database error: ' . $e->getMessage());
        }
    }


    public function getStudents()
    {
        try {
            $result = [];
            $stmt = $this->database->connect()->prepare('SELECT * FROM users WHERE role=?');
            $stmt->execute(["student"]);

            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($students as $student) {
                $result[] = new User(
                    $student['user_id'],
                    $student['email'],
                    $student['password_hash'],
                    $student['username'],
                    $student['role']
                );
            }

            return $result;

        } catch (PDOException $e) {
            // Obsługa błędów związanych z bazą danych
            die('Database error: ' . $e->getMessage());
        }
    }

    public function getStudentById(int $studentId)
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM users WHERE user_id = ?');
            $stmt->execute([$studentId]);
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$userData) {
                return null; // Użytkownik o podanym id nie istnieje
            }

            return new User(
                $userData['user_id'],
                $userData['email'],
                $userData['password_hash'],
                $userData['username'],
                $userData['role']
            // Dodaj inne pola, jeśli są dostępne w tabeli users
            );
        } catch (PDOException $e) {
            // Obsługa błędów związanych z bazą danych
            die('Database error: ' . $e->getMessage());
        }
    }

    public function alterUserProfile(int $userId, array $postData): bool
    {
        try {
            // Pobierz dane z formularza
            $newUsername = $postData['username'];
            $newEmail = $postData['email'];
            $newPassword = $postData['password'];

            // Sprawdź, czy nowe hasło zostało podane
            if (!empty($newPassword)) {
                // Haszuj nowe hasło za pomocą password_hash
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

                // Aktualizuj dane użytkownika w bazie danych, uwzględniając nowe hasło
                $stmt = $this->database->connect()->prepare('UPDATE users SET username=?, email=?, password_hash=? WHERE user_id=?');
                $stmt->execute([$newUsername, $newEmail, $hashedPassword, $userId]);
            } else {
                // Jeśli nowe hasło nie zostało podane, aktualizuj dane bez zmiany hasła
                $stmt = $this->database->connect()->prepare('UPDATE users SET username=?, email=? WHERE user_id=?');
                $stmt->execute([$newUsername, $newEmail, $userId]);
            }

            return true; // Zwróć true, jeśli aktualizacja zakończy się sukcesem
        } catch (PDOException $e) {
            // Obsługa błędów związanych z bazą danych
            die('Database error: ' . $e->getMessage());
        }
    }

}
