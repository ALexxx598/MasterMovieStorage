<?php

namespace App\StorageDomain\Media\RestrictionFactory;

use App\StorageDomain\Media\Exception\ValidationMediaException;
use App\StorageDomain\Media\Exception\ValidatorCreationFailedException;
use App\StorageDomain\Media\MediaUploadMimeType;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

class MovieImageRestriction implements MediaRestrictionInterface
{
    /**
     * @inheritDoc
     */
    public function validate(UploadedFile $file): void
    {
        try {
            Validator::extend(
                'file_extension',
                function($attribute, $file, $parameters) {
                    return in_array($file->getClientOriginalExtension(), $parameters);
                },
                sprintf(
                    'The file extension must be %s, but was - %s.',
                    MediaUploadMimeType::png(),
                    $file->getClientOriginalExtension()
                )
            );

            $validator = Validator::make(
                [
                    'file' => $file,
                ],
                [
                    'file' => [
                        sprintf(
                            'mimes:%s,%s',
                            MediaUploadMimeType::png(),
                            MediaUploadMimeType::jpeg(),
                        ),
                        'dimensions:max_width=1920,max_height=1920',
                        sprintf(
                            'file_extension:%s,%s',
                            MediaUploadMimeType::png(),
                            MediaUploadMimeType::jpeg(),
                        ),
                    ],
                ],
                [
                    'file.mimes' => sprintf(
                        'The file mime type must be - %s, but was %s.',
                        MediaUploadMimeType::png(),
                        $file->getMimeType()
                    ),
                    'file.dimensions' => 'The file has invalid image dimensions.',
                ]
            );
        } catch (Exception $exception) {
            throw new ValidatorCreationFailedException();
        }

        if ($validator->fails()) {
            throw new ValidationMediaException($validator->getMessageBag()->all());
        }
    }
}
