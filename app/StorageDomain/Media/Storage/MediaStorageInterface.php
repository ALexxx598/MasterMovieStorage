<?php

namespace App\StorageDomain\Media\Storage;

use Illuminate\Http\UploadedFile;

interface MediaStorageInterface
{
    /**
     * @param string $folderPath
     * @param UploadedFile $file
     * @param string $name
     * @return string
     */
    public function uploadFile(string $folderPath, UploadedFile $file, string $name): string;

    /**
     * @param string $path
     * @return string
     */
    public function getFileUrl(string $path): string;

    /**
     * @param string $path
     * @return bool
     */
    public function isPathValid(string $path): bool;
}
