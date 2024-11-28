<?php

namespace App\StorageDomain\Media;

use Spatie\Enum\Enum;

/**
 * @method static self MOVIE_IMAGE()
 * @method static self MOVIE_VIDEO()
 */
class MediaTypeEnum extends Enum
{
    public const MOVIE_IMAGE = 'MOVIE_IMAGE';
    public const MOVIE_VIDEO = 'MOVIE_VIDEO';
}
