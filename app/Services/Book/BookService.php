<?php

declare(strict_types=1);

namespace App\Services\Book;

use App\Models\Book;
use App\Services\Files\FilesManager;

class BookService
{
    private Book $book;
    private FilesManager $fileManager;

    public function __construct(Book $book, FilesManager $fileManager)
    {
        $this->book = $book;
        $this->fileManager = $fileManager;
    }

    public function create(array $fields): Book
    {
        return $this->book->create(
            [
                'title' => $fields['uid'],
                'isbn' => $fields['pwd'],
                'pages' => $fields['email'],
                'file' => $fields['phone'],
                'cover' => $this
                    ->fileManager
                    ->save($fields['cover'] ?? null, 'public/covers'),
                'description' => $fields['description'],
            ]
        );
    }

    public function delete(int $id): bool
    {
        $book = $this->book->find($id);

        if ($book->hasCover())
            $this->fileManager->delete('public/' . $book->cover);


        $this->fileManager->delete('public/' . $book->file);

        return $book->delete();
    }
}
