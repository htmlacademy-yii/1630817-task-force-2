<?php
namespace myorg\Task;

class StartTask extends AbstractTaskAction
{

    const START_TASK = 'startTask';

    public function getName(){
        return self::START_TASK;
    }

    public function getInternalName(){
        return CancelTask::class;
    }

    public function checkRights($customerId, $performerId, $currentUserId){
        
        if($customerId === $currentUserId){
            return true; 
        }

        return false;
    
    }

}