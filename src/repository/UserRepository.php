<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{    
    public function getUsers(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users;
        ');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

         foreach ($users as $user) {
             $result[] = new User(
                 $user['email'],
                 $user['hashedPassword'],
                 $user['username']
             );
         }

        return $result;
    }
}
