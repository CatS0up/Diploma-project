<?php

declare(strict_types=1);

namespace App\Services\Book;

use App\Models\Book;
use App\Services\Files\BookFilesService;

class BookService
{
    private Book $book;
    private BookFilesService $file;
    private BookDetailsService $details;

    public function __construct(
        Book $book,
        BookFilesService $file,
        BookDetailsService $details,

    ) {
        $this->book = $book;
        $this->file = $file;
        $this->details = $details;
    }

    public function create(array $fields): Book
    {
        $book = $this->book->create(
            [
                'publisher_id' => $fields['publisher'],
                'title' => $fields['title'],
                'slug' => $fields['title'],
                'isbn' => $fields['isbn'],
                'pages' => $fields['pages'],
                'description' => $fields['description'],
                'publishing_date' => $fields['publishing_date']
            ]
        );

        if (isset($fields['cover']))
            $this->file->setBook($book->id)->addCover($fields['cover']);

        $this->file->setBook($book->id)->addTextFile($fields['pdf']);

        $this->details->addGenres($book, $fields['genres']);

        $this->details->addAuthors($book, $fields['authors']);

        return $book;
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
