<?php

declare(strict_types=1);

namespace App\Services\Files;

use App\Models\Book;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\UploadedFile;

class BookFilesService
{
    private FilesystemManager $file;

    private Book $book;

    private bool $bookIsAssigned = false;

    public function __construct(FilesystemManager $file, Book $book)
    {
        $this->file = $file;
        $this->book = $book;
    }

    public function setBook(int $id): BookFilesService
    {
        $this->owner = $this->owner->find($id);

        $this->ownerIsAssigned = !$this->ownerIsAssigned;

        return $this;
    }

    public function addCover(UploadedFile $cover): bool
    {
        if (!$this->bookIsAssigned())
            return false;

        $this->owner->update(['cover' => $this->file
            ->disk('public')
            ->put('cover', $cover)]);

        return $this->book->hasCover();
    }

    public function updateCover(UploadedFile $cover): bool
    {
        if (!$this->bookIsAssigned())
            return false;

        $this->deleteCover();

        return $this->addCover($cover);
    }

    public function deleteCover(): bool
    {
        if (!$this->bookIsAssigned())
            return false;

        $isDeleted = false;

        if ($this->book->hasCover())
            $isDeleted = $this->file->delete($this->book->cover);

        $this->owner->update(['cover' => null]);

        return $isDeleted && !$this->book->hasCover();
    }

    public function addTextFile(UploadedFile $file): bool
    {
        if (!$this->bookIsAssigned())
            return false;

        $this->owner->update(['file' => $this->file
            ->disk('local')
            ->put('pdfs', $file)]);

        return $this->book->hasCover();
    }

    public function deleteTextFile(): bool
    {
        if (!$this->bookIsAssigned())
            return false;

        $isDeleted = false;

        if ($this->book->hasFile())
            $isDeleted = $this->file->delete($this->book->file);

        $this->owner->update(['file' => null]);

        return $isDeleted && !$this->book->hasFile();
    }

    public function updateTextFile(UploadedFile $file): bool
    {
        if (!$this->bookIsAssigned())
            return false;

        $this->deleteTextFile();

        return $this->addTextFile($file);
    }

    private function bookIsAssigned(): bool
    {
        return $this->bookIsAssigned;
    }
}
