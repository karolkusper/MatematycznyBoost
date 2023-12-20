<?php

class Homework
{
    private $teacherId;

  private $title;
  private $description;
  private $path;

    public function __construct(string $teacherId,string $title, string $description, string $path)
    {
        $this->teacherId=$teacherId;
        $this->title = $title;
        $this->description = $description;
        $this->path = $path;
    }

    public function getTeacherId(): string
    {
        return $this->teacherId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPath(): string
    {
        return $this->path;
    }


}