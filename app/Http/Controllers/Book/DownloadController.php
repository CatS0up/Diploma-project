<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Services\Files\FilesManager;

class DownloadController extends Controller
{
    private Book $book;

    public function __construct(Book $book, FilesManager $fileManager)
    {
        $this->book = $book;
        $this->fileManager = $fileManager;
    }

    public function __invoke(string $slug)
    {
        return $this->fileManager->download(
            $this->book->findWhere('slug', $slug),
            $slug
        );
    }
}
