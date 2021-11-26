<?php

use myorg\Exceptions\WrongStatusException;
use myorg\Task\Task;

require_once 'vendor/autoload.php';

$newTask = new Task(1,'test');
$newTask->currentUserId = 1;
$newTask->taskPerformerId = 3;

try {
    var_dump($newTask->getAvailableActions($newTask::STATUS_NEW));
} catch (WrongStatusException $exception) {
    error_log($exception);
    echo $exception->getMessage();
}
