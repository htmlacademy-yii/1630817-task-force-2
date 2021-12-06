<?php
namespace myorg\Task;

class RefuseFromTask extends AbstractTaskAction 
{

    const REFUSE_FROM_TASK = 'refuseFromTask';

    public function getName(){
        return self::REFUSE_FROM_TASK;
    }

    public function getInternalName(){
        return CancelTask::class;
    }

    public function checkRights($customerId, $performerId, $currentUserId){
        
        if($performerId === $currentUserId){
            return true; 
        }

        return false;
    
    }

}