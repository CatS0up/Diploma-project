<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Filesystem\FilesystemManager;

class DownloadController extends Controller
{
    private Book $book;
    private FilesystemManager $file;

    public function __construct(Book $book, FilesystemManager $file)
    {
        $this->book = $book;
        $this->file = $file;
    }

    public function __invoke(string $slug)
    {
        return $this->file->download(
            $this->book->firstwhere('slug', $slug)->file,
            $slug
        );
    }
}
