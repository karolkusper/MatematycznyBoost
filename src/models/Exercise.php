<?php

class Exercise
{
  private $title;
  private $desctiption;
  private $exercise;

  //to do
    //dodać pole użytkownika który dodał zadanie,

    public function __construct(string $title, string $desctiption, string $exercise)
    {
        $this->title = $title;
        $this->desctiption = $desctiption;
        $this->exercise = $exercise;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getDesctiption(): string
    {
        return $this->desctiption;
    }

    public function setDesctiption(string $desctiption)
    {
        $this->desctiption = $desctiption;
    }

    public function getExercise(): string
    {
        return $this->exercise;
    }

    public function setExercise(string $exercise)
    {
        $this->exercise = $exercise;
    }


}