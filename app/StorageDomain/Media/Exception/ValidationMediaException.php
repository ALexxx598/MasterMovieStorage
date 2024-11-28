<?php

namespace App\StorageDomain\Media\Exception;

use Mockery\Exception;
use Throwable;

class ValidationMediaException extends Exception
{
    /**
     * @param array $messages
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(array $messages = [], $code = 0, Throwable $previous = null)
    {
        parent::__construct(implode(' ', $messages), $code, $previous);
    }
}
