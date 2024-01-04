<?php
//class Homework
//{
//    public $homework_id;
//
//    public $teacher_id;
//    public $assigned_to;
//    public $title;
//    public $description;
//    public $task_path;
//
//    // Constructor
//    public function __construct(int $homework_id,int $teacherId, int $assignedTo, string $title, string $description, string $taskPath)
//    {
//        $this->homework_id=$homework_id;
//        $this->teacherId = $teacherId;
//        $this->assignedTo = $assignedTo;
//        $this->title = $title;
//        $this->description = $description;
//        $this->taskPath = $taskPath;
//    }
//
//
//    public function getHomeworkId():int
//    {
//        return $this->homework_id;
//    }
//
//
//
//    // Getter methods if needed
//    public function getTeacherId():int
//    {
//        return $this->teacher_id;
//    }
//
//    public function getAssignedTo():int
//    {
//        return $this->assigned_to;
//    }
//
//    public function getTitle():string
//    {
//        return $this->title;
//    }
//
//    public function getDescription():string
//    {
//        return $this->description;
//    }
//
//    public function getTaskPath():string
//    {
//        return $this->task_path;
//    }
//}



class Homework
{
  private $homework_id;
  private $teacherId;
  private $assignTo;
  private $title;
  private $description;
  private $path;

    public function __construct(int $homework_id,int $teacherId,int $assignTo,string $title, string $description, string $path)
    {
        $this->homework_id=$homework_id;
        $this->teacherId=$teacherId;
        $this->assignTo=$assignTo;
        $this->title = $title;
        $this->description = $description;
        $this->path = $path;
    }

    public function getHomeworkId(): int
    {
        return $this->homework_id;
    }


    public function getTeacherId(): int
    {
        return $this->teacherId;
    }

    public function getAssignTo(): int
    {
        return $this->assignTo;
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