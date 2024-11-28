<?php

namespace App\StorageDomain\Media\Payload;

use App\StorageDomain\Media\MediaTypeEnum;

class MediaSavedPayload
{
    /**
     * @param MediaTypeEnum $mediaType
     * @param string $url
     */
    private function __construct(
        private MediaTypeEnum $mediaType,
        private string $url
    ) {
    }

    /**
     * @param MediaTypeEnum $mediaType
     * @param string $url
     * @return MediaSavedPayload
     */
    public static function make(MediaTypeEnum $mediaType, string $url): MediaSavedPayload
    {
        return new MediaSavedPayload($mediaType, $url);
    }

    /**
     * @return MediaTypeEnum
     */
    public function getMediaType(): MediaTypeEnum
    {
        return $this->mediaType;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
