<?php
require_once 'Maps/TaskData.php';

class Task
{
    const STATUS_NEW = 'Новое задание';
    const STATUS_CANCELED = 'Задание отмененно';
    const STATUS_IN_WORK = 'В работе';
    const STATUS_DONE = 'Выполнено';
    const STATUS_FAILED = 'Провалено';

    public $status;
    public $authorID;
    public $description;
    public $taskPerformerId;

    public function __construct($authorID, $description)
    {
        $this->authorID = $authorID;
        $this->description = $description;
    }

    public function getNextStatus($actionName)
    {
        if ($actionName === 'startTask') {
            return self::STATUS_NEW;
        } elseif ($actionName === 'finishTheTask') {
            return self::STATUS_DONE;
        } elseif ($actionName === 'refuseFromTask') {
            return self::STATUS_FAILED;
        } elseif ($actionName === 'cancelTask') {
            return self::STATUS_CANCELED;
        } elseif ($actionName === 'respondToTheTask') {
            return self::STATUS_IN_WORK;
        }
        return $this->status;
    }

    public function getAvailableActions($statusName)
    {
        if ($statusName === 'STATUS_NEW') {
            return ['cancelTask', 'respondToTask'];
        } elseif ($statusName === 'STATUS_CANСELED') {
            return false;
        } elseif ($statusName === 'STATUS_IN_WORK') {
            return ['finishTheTask', 'refuseFromTask'];
        } elseif ($statusName === 'STATUS_DONE') {
            return false;
        } elseif ($statusName === 'STATUS_FAILED') {
            return false;
        }
    }

    public function getStatusesMap()
    {
        global $statuses;
        return $statuses;
    }

    public function getActionsMap()
    {
        global $actions;
        return $actions;
    }


}
