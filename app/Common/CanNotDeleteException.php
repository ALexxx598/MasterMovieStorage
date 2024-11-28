<?php

namespace App\Common;

use Exception;

class CanNotDeleteException extends Exception
{
    protected $message = 'Can not delete model.';
}
