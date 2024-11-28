<?php

namespace App\StorageDomain\Media\Storage;

use Carbon\Carbon;
use Google\Cloud\Core\Exception\NotFoundException;
use Illuminate\Http\UploadedFile;
use Kreait\Laravel\Firebase\Facades\Firebase;

class FirebaseMediaStorage implements MediaStorageInterface
{
    /**
     * @param string $folderPath
     * @param UploadedFile $file
     * @param string $name
     * @return string
     */
    public function uploadFile(string $folderPath, UploadedFile $file, string $name): string
    {
        $image = Firebase::storage()
            ->getBucket()
            ->upload($file->getContent(), ['name' => $folderPath . $name]);

        return $image->info()['name'];
    }

    /**
     * @param string $path
     * @return string
     */
    public function getFileUrl(string $path): string
    {
        return Firebase::storage()->getBucket()->object($path)->signedUrl(Carbon::tomorrow());
    }

    /**
     * @param string $path
     * @return bool
     */
    public function isPathValid(string $path): bool
    {
        try {
            Firebase::storage()->getBucket()->exists();
        } catch (NotFoundException $e) {
            return false;
        }

        return true;
    }
}
