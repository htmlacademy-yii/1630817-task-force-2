<?php
require_once 'Classes\Task\TaskInteface.php';

class Task implements TaskInterface
{
    const STATUS_NEW = 'Новое задание';
    const STATUS_CANСELED = 'Задание отмененно';
    const STATUS_IN_WORK = 'В работе';
    const STATUS_DONE = 'Выполнено';
    const STATUS_FAILED = 'Провалено';

    public $status;
    public $authorID;
    public $description;
    public $taskPerformerId;
    public $availableMethods;

    public function __construct($authorID, $description)
    {
        $this->authorID = $authorID;
        $this->description = $description;
    }

    public function respondToTheTask(){
        $this->availableMethods = ['finishTheTask', 'refuseFromTask'];
        $this->status = self::STATUS_IN_WORK;
    }

    public function finishTheTask(){
        $this->availableMethods = [];
        $this->status = self::STATUS_DONE;
    }

    public function refuseFromTask(){
        $this->availableMethods = [];
        $this->status = self::STATUS_FAILED;
    }

    public function cancelTask(){
        $this->availableMethods = [];
        $this->status = self::STATUS_CANСELED;
    }

    public function startTask(){
        $this->availableMethods = ['cancelTask', 'respondToTask'];
        $this->status = self::STATUS_NEW;
    }

    public function getNextStatus($actionName)
    {
        $this->$actionName();
        return $this->status;
    }

    public function setStatus($statusName)
    {
        return $this->status = $statusName;
    }

    public function getAvailableActions()
    {
        return $this->availableMethods;
    }




}
