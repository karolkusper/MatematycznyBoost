<?php

class User
{
    private $id;
    private $email;
    private $password;
    private $username;

    private $role;

//    private $surname;

    public function __construct(int $id, string $email, string $password, string $username, string $role /*, string $surname*/)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->role = $role;
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    public function getPassword(): string
    {
        return $this->password;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getRole(): string
    {
        return $this->role;
    }


}
