<?php

// UserRepository.php
require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

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
                $userData['email'],
                $userData['password_hash'],
                $userData['username']
            // Dodaj inne pola, jeśli są dostępne w tabeli users
            );
        } catch (PDOException $e) {
            // Obsługa błędów związanych z bazą danych
            die('Database error: ' . $e->getMessage());
        }
    }

    // Dodaj inne funkcje związane z użytkownikami, jeśli są potrzebne

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
}
