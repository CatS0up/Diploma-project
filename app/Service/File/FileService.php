<?php

declare(strict_types=1);

namespace App\Service\File;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    private const DEFAULT_DISK = 'public';

    private string $disk;

    public function __construct()
    {
        $this->disk = self::DEFAULT_DISK;
    }

    public function disk(string $disk = self::DEFAULT_DISK): self
    {
        $this->disk = $disk;

        return $this;
    }

    public function save(string $dir, UploadedFile $file): string
    {
        return $file->store($dir, $this->disk);
    }

    public function update(
        ?string $oldFilePath,
        UploadedFile $file,
        string $dir
    ): string {
        if ($oldFilePath)
            $this->delete($oldFilePath);

        return $this->save($dir, $file);
    }

    public function delete(string $pathToFile): bool
    {
        Storage::disk($this->disk)->delete($pathToFile);

        return Storage::disk($this->disk)->missing($pathToFile);
    }
}
