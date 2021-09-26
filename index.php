<?php
require_once 'vendor/autoload.php';

$newTask = new myorg\Task\Task(1,'test');
assert($newTask->getNextStatus('respondToTheTask') == Task::STATUS_IN_WORK, 'respond To The Task');

