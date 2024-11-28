<?php

namespace App\Http\Request\Media;

use App\Common\MovieStorageRequest;
use App\StorageDomain\Media\MediaTypeEnum;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;

class MediaUploadRequest extends MovieStorageRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'int',
            ],
            'media_type' => [
                'required',
                'string',
                Rule::in(MediaTypeEnum::toArray()),
            ],
            'media' => [
                'required',
                'file',
            ],
        ];
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->input('user_id');
    }

    /**
     * @return string
     */
    public function getMediaType(): string
    {
        return $this->input('media_type');
    }

    /**
     * @return \Illuminate\Http\UploadedFile
     */
    public function getMediaFile(): UploadedFile
    {
        return $this->file('media');
    }
}
