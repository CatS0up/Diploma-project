<?php

declare(strict_types=1);

namespace App\Service;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    public function download(string $file, string $filename = 'file'): StreamedResponse
    {
        return Storage::download($file, $filename);
    }
}
