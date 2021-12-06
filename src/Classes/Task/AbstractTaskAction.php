<?php 
namespace myorg\Task;

abstract class AbstractTaskAction 
{

    abstract public function getName();

    abstract public function getInternalName();

    abstract public function checkRights($customerId, $performerId, $currentUserId);

}
