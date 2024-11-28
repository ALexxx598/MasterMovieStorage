<?php

namespace App\StorageDomain\Media\Exception;

use Exception;

class UnknownMediaRestrictionException extends Exception
{
    protected $message = 'Unknown media restriction';
}
