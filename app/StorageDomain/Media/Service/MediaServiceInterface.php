<?php

namespace App\StorageDomain\Media\Service;

use App\StorageDomain\Media\Exception\UnsupportedMediaType;
use App\StorageDomain\Media\Payload\MediaSavedPayload;
use App\StorageDomain\Media\Payload\MediaUploadPayload;
use Exception;

interface MediaServiceInterface
{
    /**
     * @param MediaUploadPayload $payload
     * @return MediaSavedPayload
     * @throws UnsupportedMediaType
     * @throws Exception
     */
    public function upload(MediaUploadPayload $payload): MediaSavedPayload;

    /**
     * @param string $path
     * @return string
     */
    public function getFileUrl(string $path): string;

    /**
     * @param string $path
     * @return bool
     */
    public function validatePath(string $path): bool;
}
