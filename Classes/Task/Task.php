<?php
namespace myorg\Task;

use http\Exception;
use myorg\Exceptions\WrongStatusException;

class Task
{
    const STATUS_NEW = 'new';
    const STATUS_CANCELED = 'cancel';
    const STATUS_IN_WORK = 'in_work';
    const STATUS_DONE = 'done';
    const STATUS_FAILED = 'failed';


    const RESPOND_TO_THE_TASK = 'respondToTheTask';
    const FINISH_THE_TASK = 'finishTheTask';
    const REFUSE_FROM_TASK = 'refuseFromTask';
    const CANCEL_TASK = 'cancelTask';
    const START_TASK = 'startTask';

    public $status;
    public $authorID;
    public $description;
    public $currentUserId;
    public $taskPerformerId;
    public static $statuses = [
        'STATUS_NEW'      => 'new',
        'STATUS_CANCELED' => 'cancel',
        'STATUS_IN_WORK'  => 'in_work',
        'STATUS_DONE'     => 'done',
        'STATUS_FAILED'   => 'failed',
    ];

    public static $actions = [
        'respondToTheTask' => 'Откликнуться на задание',
        'finishTheTask' => 'Закончить задание',
        'refuseFromTask' => 'Отказаться от задания',
        'cancelTask' => 'Отменить задание',
        'startTask' => 'Начать выполнение',
    ];


    public function __construct(int $authorID, string $description, string $status = self::STATUS_NEW)
    {
        $this->authorID = $authorID;
        $this->description = $description;

        if(!in_array($status, $this->getStatusesMap())){
            throw new WrongStatusException();
        } else {
            $this->status = $status;
        }
    }

    public function getNextStatus(string $actionName) : string
    {
        switch ($actionName) {
            case self::START_TASK:
                return self::STATUS_NEW;
            case self::FINISH_THE_TASK:
                return self::STATUS_DONE;
            case self::REFUSE_FROM_TASK:
                return self::STATUS_FAILED;
            case self::CANCEL_TASK:
                return self::STATUS_CANCELED;
            case self::RESPOND_TO_THE_TASK:
                return self::STATUS_IN_WORK;
        }

    }



    public function getAvailableActions(string $statusName) : array
    {
        if(!in_array($statusName, $this->getStatusesMap())){
            throw new WrongStatusException();
        }

        switch ($statusName) {
            case self::STATUS_NEW:
                $isCancelAvailable = (new CancelTask)->checkRights($this->authorID,$this->taskPerformerId, $this->currentUserId);
                $isRespondAvailable = (new RespondToTheTask)->checkRights($this->authorID,$this->taskPerformerId, $this->currentUserId);

                return [$isCancelAvailable ? new CancelTask : 'cancel is not available',  $isRespondAvailable ? new RespondToTheTask :'respond is not available'];

            case self::STATUS_IN_WORK:
                $isFinishAvailable = (new FinishTask)->checkRights($this->authorID,$this->taskPerformerId, $this->currentUserId);
                $isRefuseAvailable = (new RefuseFromTask)->checkRights($this->authorID,$this->taskPerformerId, $this->currentUserId);

                return [$isFinishAvailable ? new FinishTask : 'Finish is not available',  $isRefuseAvailable ? new RefuseFromTask :'refuse is not available'];

            case self::STATUS_DONE:
            case self::STATUS_FAILED:
            case self::STATUS_CANCELED:
                return [];
        }
    }

    public function getStatusesMap(): array
    {
        return self::$statuses;
    }

    public function getActionsMap(): array
    {
        return self::$actions;
    }


}
