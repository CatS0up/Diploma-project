<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Repository\BookRepository;
use App\Repository\GenreRepository;
use App\Repository\PublisherRepository;
use App\Service\FileService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    private BookRepository $bookRepostiory;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepostiory = $bookRepository;
    }

    public function show(int $id): View
    {
        return view('book.show', ['book' => $this->bookRepostiory->get($id)]);
    }

    public function list(
        Request $request,
        GenreRepository $genreRepository,
        PublisherRepository $publisherRepository
    ): View {
        return view('book.list', [
            'genres' => $genreRepository->all(),
            'publishers' => $publisherRepository->all(),
            'books' => $this->bookRepostiory->all(),
            'phrase' => $request->query('q')
        ]);
    }

    public function download(FileService $file, int $id)
    {
        $book = $this->bookRepostiory->get($id);

        return $file->download($book->file, $book->title);
    }
}
