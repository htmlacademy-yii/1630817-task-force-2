<?php
require_once 'Classes\Task\Task.php';

$newTask = new Task(1,'test');
//var_dump($newTask->getNextStatus('respondToTheTask'),$newTask->getAvailableActions());
print(assert($newTask->getNextStatus('respondToTheTask') == Task::STATUS_IN_WORK, 'respond To The Task'));
