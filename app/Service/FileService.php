<?php

declare(strict_types=1);

namespace App\Service;

use Illuminate\Http\UploadedFile;

class FileService
{
    public function savePublic(string $dir, UploadedFile $file): string
    {
        return $file->store($dir, 'public');
    }

    public function saveLocal(string $dir, UploadedFile $file): string
    {
        return $file->store($dir, 'local');
    }
}
