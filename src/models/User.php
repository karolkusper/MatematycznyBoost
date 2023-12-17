<?php

class User{
    private $email;
    private $hashedPassword;
    private $username;
//    private $surname;

    public function __construct(string $email, string $password, string $username /*, string $surname*/)
    {
        $this->email = $email;
        $this->hashedPassword = password_hash($password,PASSWORD_BCRYPT);
        $this->username = $username;
//        $this->surname = $surname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getHashedPassword(): string
    {
        return $this->hashedPassword;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }


    public function getUsername():string
    {
        return $this->username;
    }


    public function setUsername($username)
    {
        $this->username = $username;
    }


//    public function getName(): string
//    {
//        return $this->name;
//    }
//
//    public function setName(string $name)
//    {
//        $this->name = $name;
//    }
//
//    public function getSurname(): string
//    {
//        return $this->surname;
//    }
//
//    public function setSurname(string $surname)
//    {
//        $this->surname = $surname;
//    }




}
