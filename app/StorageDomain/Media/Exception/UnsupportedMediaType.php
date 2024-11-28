<?php

namespace App\StorageDomain\Media\Exception;

use Exception;

class UnsupportedMediaType extends Exception
{
    protected $message = 'Unsupported media type';
}
