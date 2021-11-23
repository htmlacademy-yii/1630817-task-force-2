<?php
namespace myorg\Task;

class FinishTask extends AbstractTaskAction 
{

    const FINISH_TASK = 'finishTask';

    public function getName(){
        return self::FINISH_TASK;
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