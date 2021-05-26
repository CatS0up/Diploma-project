<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Service\Book\BookService;
use App\Service\File\FileService;

class DownloadController extends Controller
{
    private BookService $book;

    public function __construct(BookService $book, FileService $file)
    {
        $this->book = $book;
        $this->file = $file;
    }

    public function __invoke(string $slug)
    {
        return $this->file->download(
            $this->book->findBySlug($slug)->file,
            $slug
        );
    }
}
