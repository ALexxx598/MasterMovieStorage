<?php

namespace App\StorageDomain\Media\RestrictionFactory;

use App\StorageDomain\Media\Exception\ValidationMediaException;
use App\StorageDomain\Media\Exception\ValidatorCreationFailedException;
use Illuminate\Http\UploadedFile;

interface MediaRestrictionInterface
{
    /**
     * @param \Illuminate\Http\UploadedFile $file
     * @throws ValidationMediaException
     * @throws ValidatorCreationFailedException
     */
    public function validate(UploadedFile $file): void;
}
