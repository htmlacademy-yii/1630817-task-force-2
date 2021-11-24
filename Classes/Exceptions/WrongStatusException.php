<?php 
namespace myorg\Exceptions;

use Exception;

class WrongStatusException extends Exception
{
    public $message = 'Неправильный статус';

}
