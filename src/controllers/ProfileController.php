<?php

require_once 'AppController.php';

class ProfileController extends AppController
{
    public function myProfile()
    {
        // Sprawdź, czy użytkownik jest zalogowany
        $this->isLoggedIn();

        // Odczytaj dane użytkownika bezpośrednio z sesji
        $user = $_SESSION['user'];

        $this->render('myProfile', ['user' => $user]);
    }

    public function alterProfile()
    {
        // Pobierz dane z żądania
        $postData = json_decode(file_get_contents('php://input'), true);

        // Sprawdź, czy użytkownik jest zalogowany
        $this->isLoggedIn();

        // Odczytaj dane użytkownika bezpośrednio z sesji
        $user = $_SESSION['user'];

        // Tutaj użyj UserRepository do aktualizacji danych użytkownika w bazie danych
        $userRepository = new UserRepository();
        $success = $userRepository->alterUserProfile($user['id'], $postData);

        // Odpowiedź na żądanie (możesz użyć JSON lub innego formatu)
        if ($success) {
            echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update profile']);
        }
    }

    public function updateSession()
    {
        // Odczytaj dane z ciała żądania
        $data = json_decode(file_get_contents('php://input'), true);

// Zaktualizuj sesję użytkownika
        $_SESSION['user']['username'] = $data['newUsername'];
        $_SESSION['user']['email'] = $data['newEmail'];

// Odpowiedź do klienta
        echo json_encode(['status' => 'success']);
    }
}