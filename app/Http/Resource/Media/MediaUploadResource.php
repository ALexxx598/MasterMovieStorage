<?php

namespace App\Http\Resource\Media;

use App\Common\MovieStorageResource;
use App\StorageDomain\Media\Payload\MediaSavedPayload;

/**
 * @mixin MediaSavedPayload
 */
class MediaUploadResource extends MovieStorageResource
{
    /**
     * @inheritDoc
     */
    public function toArray($request): array
    {
        return [
            'url' => $this->getUrl(),
            'media_type' => $this->getMediaType(),
        ];
    }
}
