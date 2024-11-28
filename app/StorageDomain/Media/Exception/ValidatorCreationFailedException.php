<?php

namespace App\StorageDomain\Media\Exception;

use Mockery\Exception;

class ValidatorCreationFailedException extends Exception
{
    protected $message =' Validator creation failed.';
}
