<?php

declare(strict_types=1);

namespace App\Services\Files;

use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\UploadedFile;

class FilesManager
{
    private FilesystemManager $filesystem;

    public function __construct(FilesystemManager $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function save(?UploadedFile $file, string $path): ?string
    {
        if (!$file)
            return null;

        $components = $this->parsePath($path);

        return $file->store($components['directory'], $components['disk']);
    }

    public function delete(string $path): bool
    {
        $components = explode('/', $path);

        $this->filesystem
            ->disk($components['disk'])
            ->delete($components['directory'] . '/' . $components['filename']);

        return $this->filesystem->missing($path);
    }

    public function update(
        ?string $oldPath,
        ?UploadedFile $file,
        string $path
    ): ?string {
        if (!$file)
            return null;

        $this->reset($oldPath);

        return $this->save($file, $path);
    }

    public function reset(?string $oldPath): ?bool
    {
        if ($oldPath)
            return $this->filesystem->delete($oldPath);

        return null;
    }

    private function parsePath(string $path): array
    {
        $components = explode('/', $path);

        return [
            'disk' => $components[0],
            'directory' => $components[1],
            'filename' => $components[2] ?? null
        ];
    }
}
