<?php

class HomeworkSolution
{
private $solutionId;
private $userId;
private $homeworkId;
private $homeworkTitle;
private $homeworkDescription;
private $solutionPath;

private $grade;


    public function __construct(int $solutionId, int $userId, int $homeworkId, string $homeworkTitle, string $homeworkDescription, string $solutionPath, int $grade)
    {
        $this->solutionId = $solutionId;
        $this->userId = $userId;
        $this->homeworkId = $homeworkId;
        $this->homeworkTitle = $homeworkTitle;
        $this->homeworkDescription = $homeworkDescription;
        $this->solutionPath = $solutionPath;
        $this->grade=$grade;
    }

    public function getSolutionId(): int
    {
        return $this->solutionId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getHomeworkId(): int
    {
        return $this->homeworkId;
    }

    public function getHomeworkTitle(): string
    {
        return $this->homeworkTitle;
    }

    public function getHomeworkDescription(): string
    {
        return $this->homeworkDescription;
    }

    public function getSolutionPath(): string
    {
        return $this->solutionPath;
    }

    public function getGrade(): int
    {
        return $this->grade;
    }


}