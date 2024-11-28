<?php

namespace App\Common;

use Exception;

class NotFoundException extends Exception
{
    protected $message = 'Not found model';
}
