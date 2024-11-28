<?php

namespace App\StorageDomain\Media\Service;

use App\StorageDomain\Media\Exception\UnsupportedMediaType;
use App\StorageDomain\Media\MediaTypeEnum;
use App\StorageDomain\Media\Payload\MediaSavedPayload;
use App\StorageDomain\Media\Payload\MediaUploadPayload;
use App\StorageDomain\Media\RestrictionFactory\MediaRestrictionFactoryInterface;
use App\StorageDomain\Media\Storage\MediaStorageInterface;
use Carbon\Carbon;
use Exception;

class MediaService implements MediaServiceInterface
{
    /**
     * @param MediaRestrictionFactoryInterface $mediaRestrictionFactory
     * @param MediaStorageInterface $mediaStorage
     */
    public function __construct(
        private MediaRestrictionFactoryInterface $mediaRestrictionFactory,
        private MediaStorageInterface $mediaStorage
    ) {
    }

    /**
     * @inheritdoc
     */
    public function upload(MediaUploadPayload $payload): MediaSavedPayload
    {
        $this->mediaRestrictionFactory
            ->make($payload->getType())
            ->validate($payload->getFile());

        $folderPath = $this->definePath($payload->getType());
        $name = $this->generateName($payload->getFile()->getClientOriginalExtension());

        $path = $this->mediaStorage->uploadFile($folderPath, $payload->getFile(), $name);

        return MediaSavedPayload::make($payload->getType(), $path);
    }

    /**
     * @inheritdoc
     */
    public function getFileUrl(string $path): string
    {
        return $this->mediaStorage->getFileUrl($path);
    }

    /**
     * @param MediaTypeEnum $type
     * @return string
     * @throws UnsupportedMediaType
     */
    private function definePath(MediaTypeEnum $type): string
    {
        return match ($type->value) {
            MediaTypeEnum::MOVIE_IMAGE => '/movie/images/',
            MediaTypeEnum::MOVIE_VIDEO => '/movie/video/',
            default => throw new UnsupportedMediaType()
        };
    }

    /**
     * @param string $fileExtension
     * @return string
     * @throws Exception
     */
    private function generateName(string $fileExtension): string
    {
        return sprintf(
            '%s%s%s.%s',
            Carbon::now()->format('Ymd'),
            intval(abs(time() / rand(1, 200))),
            bin2hex(random_bytes(4)),
            $fileExtension
        );
    }

    /**
     * @inheritDoc
     */
    public function validatePath(string $path): bool
    {
        return $this->mediaStorage->isPathValid($path);
    }
}
