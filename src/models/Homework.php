<?php
class Homework
{
    public $homework_id;

    public $teacher_id;
    public $assigned_to;
    public $title;
    public $description;
    public $task_path;

    // Constructor
//    public function __construct($teacherId, $assignedTo, $title, $description, $taskPath)
//    {
//        $this->teacherId = $teacherId;
//        $this->assignedTo = $assignedTo;
//        $this->title = $title;
//        $this->description = $description;
//        $this->taskPath = $taskPath;
//    }

    // Getter methods if needed
    public function getTeacherId()
    {
        return $this->teacher_id;
    }

    public function getAssignedTo()
    {
        return $this->assigned_to;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getTaskPath()
    {
        return $this->task_path;
    }
}


//
//class Homework
//{
//    private $teacherId;
//
//    private $assignTo;
//  private $title;
//  private $description;
//  private $path;
//
//    public function __construct(int $teacherId,int $assignTo,string $title, string $description, string $path)
//    {
//        $this->teacherId=$teacherId;
//        $this->assignTo=$assignTo;
//        $this->title = $title;
//        $this->description = $description;
//        $this->path = $path;
//    }
//
//    public function getTeacherId(): int
//    {
//        return $this->teacherId;
//    }
//
//    public function getAssignTo(): int
//    {
//        return $this->assignTo;
//    }
//
//    public function getTitle(): string
//    {
//        return $this->title;
//    }
//
//    public function getDescription(): string
//    {
//        return $this->description;
//    }
//
//    public function getPath(): string
//    {
//        return $this->path;
//    }
//
//
//}