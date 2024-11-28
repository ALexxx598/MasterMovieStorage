<?php

namespace App\StorageDomain\Media;

use Spatie\Enum\Enum;

/**
 * @method static self png()
 * @method static self jpg()
 * @method static self jpeg()
 * @method static self ico()
 * @method static self mp4()
 */
class MediaUploadMimeType extends Enum
{
    protected const PNG = 'png';
    protected const JPG = 'jpg';
    protected const JPEG = 'jpeg';
    protected const ICO = 'ico';
    protected const MP4 = 'mp4';
}
