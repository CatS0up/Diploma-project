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
                'publisher_id'    => $fields['publisher'],
                'title'           => $fields['title'],
                'slug'            => $fields['title'],
                'isbn'            => $fields['isbn'],
                'pages'           => $fields['pages'],
                'description'     => $fields['description'],
                'publishing_date' => $fields['publishing_date']
            ]
        );

        $this->file->setBook($book->id);

        if (isset($fields['cover']))
            $this->file->addCover($fields['cover']);

        $this->file->addTextFile($fields['pdf']);

        $this->details->addGenres($book, $fields['genres']);

        $this->details->addAuthors($book, $fields['authors']);

        return $book;
    }

    public function delete(int $id): bool
    {
        $book = $this->book->find($id);

        $this->file->setBook($book->id);

        $this->file->deleteCover();
        $this->file->deleteTextFile();

        return $book->delete();
    }

    public function update(int $id, array $fields): bool
    {

        $book = $this->book->find($id);

        $isUpdated = $book->update(
            [
                'publisher_id'    => $fields['publisher']        ?? $book->publisher,
                'title'           => $fields['title']            ?? $book->title,
                'slug'            => $fields['title']            ?? $book->title,
                'isbn'            => $fields['isbn']             ?? $book->isbn,
                'pages'           => $fields['pages']            ?? $book->pages,
                'description'     => $fields['description']      ?? $book->description,
                'publishing_date' => $fields['publishing_datee'] ?? $book->publishing_date
            ]
        );

        if (filter_var($fields['reset_cover'], FILTER_VALIDATE_BOOLEAN)) {

            $this->file->setBook($book->id)->deleteCover();
        } else {

            if (isset($fields['avatar']))
                $this->file->setBook($book->id)->updateCover($fields['cover']);
        }

        if (isset($fields['pdf']))
            $this->file->setBook($book->id)->updateTextFile($fields['pdf']);

        $this->details->addGenres($book, $fields['genres']);

        $this->details->addAuthors($book, $fields['authors']);

        return $isUpdated;
    }
}
