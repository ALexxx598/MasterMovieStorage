<?php

namespace App\StorageDomain\Media\Storage;

use Google\Cloud\Core\Exception\NotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class LocalMediaStorage implements MediaStorageInterface
{
    /**
     * @param string $folderPath
     * @param UploadedFile $file
     * @param string $name
     * @return string
     */
    public function uploadFile(string $folderPath, UploadedFile $file, string $name): string
    {
        Storage::disk('local')->put($folderPath . $name, $file);

        return $folderPath . '/' . $name;
    }

    /**
     * @param string $path
     * @return string
     */
    public function getFileUrl(string $path): string
    {
        return env("APP_URL") . '/' . $path;
    }

    /**
     * @param string $path
     * @return bool
     */
    public function isPathValid(string $path): bool
    {
        try {
            return Storage::disk('local')->exists($path);
        } catch (NotFoundException $e) {
            return false;
        }
    }
}