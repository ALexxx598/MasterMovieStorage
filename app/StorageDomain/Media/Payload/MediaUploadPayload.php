<?php

namespace App\StorageDomain\Media\Payload;

use App\StorageDomain\Media\MediaTypeEnum;
use Illuminate\Http\UploadedFile;

class MediaUploadPayload
{
    /**
     * @param int $userId
     * @param MediaTypeEnum $type
     * @param UploadedFile $file
     */
    private function __construct(
        private int $userId,
        private MediaTypeEnum $type,
        private UploadedFile $file,
    ) {
    }

    /**
     * @param int $userId
     * @param MediaTypeEnum $type
     * @param UploadedFile $file
     * @return static
     */
    public static function make(
        int $userId,
        MediaTypeEnum $type,
        UploadedFile $file,
    ): self {
        return new self(
            userId: $userId,
            type: $type,
            file: $file
        );
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return MediaTypeEnum
     */
    public function getType(): MediaTypeEnum
    {
        return $this->type;
    }

    /**
     * @return UploadedFile
     */
    public function getFile(): UploadedFile
    {
        return $this->file;
    }
}
