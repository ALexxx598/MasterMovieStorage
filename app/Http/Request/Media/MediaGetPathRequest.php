<?php

namespace App\Http\Request\Media;

use App\Common\MovieStorageRequest;

class MediaGetPathRequest extends MovieStorageRequest
{
    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            'path' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->input('path');
    }
}
