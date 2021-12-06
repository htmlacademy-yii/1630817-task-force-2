<?php
namespace myorg\Task;


class CancelTask extends AbstractTaskAction 
{

    const CANCEL_TASK = 'cancelTask';

    public function getName(){
        return self::CANCEL_TASK;
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