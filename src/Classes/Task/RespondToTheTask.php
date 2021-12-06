<?php
namespace myorg\Task;

class RespondToTheTask extends AbstractTaskAction 
{

    const RESPOND_TO_THE_TASK = 'respondToTheTask';

    public function getName(){
        return self::RESPOND_TO_THE_TASK;
    }

    public function getInternalName(){
        return CancelTask::class;
    }

    public function checkRights($customerId, $performerId, $currentUserId){
        
        if($customerId !== $currentUserId){
            return true; 
        }

        return false;
    
    }

}