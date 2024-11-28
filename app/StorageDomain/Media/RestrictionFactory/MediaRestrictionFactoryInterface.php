<?php

namespace App\StorageDomain\Media\RestrictionFactory;

use App\StorageDomain\Media\MediaTypeEnum;

interface MediaRestrictionFactoryInterface
{
    /**
     * @param MediaTypeEnum $mediaType
     * @return MediaRestrictionInterface
     */
    public function make(MediaTypeEnum $mediaType): MediaRestrictionInterface;
}
