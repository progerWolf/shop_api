<?php

namespace App\Services;

use App\Interfaces\UploadFileServiceInterface;

class UploadFileToLocalStorageService implements UploadFileServiceInterface
{

    public function upload($file, $dir)
    {
        $file = $file->store($dir, ['disk' => 'public']);

        return "/storage/$file";
    }
}
