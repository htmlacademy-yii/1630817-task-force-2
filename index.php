<?php
require_once 'Classes\Task\Task.php';

$newTask = new Task(1,'test');
assert($newTask->getNextStatus('respondToTheTask') == Task::STATUS_IN_WORK, 'respond To The Task');
