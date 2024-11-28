<?php

namespace App\StorageDomain\Media\RestrictionFactory;

use App\StorageDomain\Media\Exception\UnknownMediaRestrictionException;
use App\StorageDomain\Media\MediaTypeEnum;

class MediaRestrictionFactory implements MediaRestrictionFactoryInterface
{
    /**
     * @param MediaTypeEnum $type
     * @return MediaRestrictionInterface
     * @throws UnknownMediaRestrictionException
     */
    public function make(MediaTypeEnum $type): MediaRestrictionInterface
    {
        $restriction = 'make' . str_replace('_', '', $type) . 'restriction';

        if (!method_exists($this, $restriction)) {
            throw new UnknownMediaRestrictionException();
        }

        return $this->{$restriction}();
    }

    /**
     * @return MovieImageRestriction
     */
    private function makeMovieImageRestriction(): MovieImageRestriction
    {
        return new MovieImageRestriction();
    }

    /**
     * @return MovieVideoRestriction
     */
    private function makeMovieVideoRestriction(): MovieVideoRestriction
    {
        return new MovieVideoRestriction();
    }
}
