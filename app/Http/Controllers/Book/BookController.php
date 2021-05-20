<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Repository\BookRepository;
use App\Repository\Filterable;
use App\Repository\GenreRepository;
use App\Repository\PublisherRepository;
use App\Service\FileService;
use App\Service\FiltersFormatter;
use Illuminate\Support\Facades\Auth;
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
        $user =  Auth::user();
        $book = $this->bookRepostiory->get($id);

        return view('book.show', [
            'book' => $book,
            'reviews' => $book->reviews()->get(),
            'userHasBook' => $user ? $user->hasBook($id) : true,
        ]);
    }

    public function list(
        FiltersFormatter $filters,
        GenreRepository $genreRepository,
        PublisherRepository $publisherRepository
    ): View {
        $filters = $filters->format(
            ['q', 'publisher', 'genre', 'sort'],
            [
                'sort' => Filterable::SORT_DEFAULT,
                'publisher' => BookRepository::PUBLISHER_ALL,
                'genre' => BookRepository::GENRE_ALL
            ]
        );

        return view('book.list', [
            'genres' => $genreRepository->all(),
            'publishers' => $publisherRepository->all(),
            'books' => $this->bookRepostiory->filterBy($filters),
            'filters' =>  $filters
        ]);
    }

    public function download(FileService $file, int $id)
    {
        $book = $this->bookRepostiory->get($id);

        return $file->download($book->file, $book->title);
    }
}
