<?php

namespace App\Exceptions;

use Spatie\Enum\Enum;

/**
 * @method static self MEDIA_UNKNOWN_RESTRICTION()
 * @method static self MEDIA_VALIDATION()
 * @method static self MEDIA_VALIDATION_CREATION()
 * @method static self MEDIA_UNSUPPORTED_TYPE()
 * @method static self UNAUTHORIZED()
 */
class ErrorCodes extends Enum
{
    public const MEDIA_UNKNOWN_RESTRICTION = '1100';
    public const MEDIA_VALIDATION = '1101';
    public const MEDIA_VALIDATION_CREATION = '1102';
    public const MEDIA_UNSUPPORTED_TYPE = '1103';

    public const UNAUTHORIZED = '2101';
}
