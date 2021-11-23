<?php

use myorg\Task\Task;

require_once 'vendor/autoload.php';

$newTask = new Task(1,'test');
$newTask->currentUserId = 1;
$newTask->taskPerformerId = 3;
var_dump($newTask->getAvailableActions($newTask::STATUS_IN_WORK));

