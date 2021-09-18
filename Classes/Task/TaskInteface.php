<?php

interface TaskInterface
{
    public function __construct($authorID, $description);

    public function respondToTheTask();

    public function finishTheTask();

    public function refuseFromTask();

    public function cancelTask();

    public function startTask();

    public function setStatus($statusName);

    public function getNextStatus($actionName);

    public function getAvailableActions();

}
