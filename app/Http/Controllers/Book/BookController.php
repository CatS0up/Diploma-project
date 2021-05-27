<?php

declare(strict_types=1);

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Service\Book\BookService;
use App\Service\Book\ListingGenreService;
use App\Service\Book\ListingPublisherService;
use App\Service\Book\ListingService;
use App\Service\BookListing;
use App\Service\FiltersFormatter;
use Illuminate\Auth\AuthManager;
use Illuminate\View\View;

class BookController extends Controller
{
    private BookService $book;
    private ListingService $bookList;

    public function __construct(BookService $book, ListingService $bookList)
    {
        $this->book = $book;
        $this->bookList = $bookList;
    }

    public function show(AuthManager $auth, string $slug): View
    {
        $user = $auth->user();

        $book = $this->book->findBySlug($slug);

        return view('book.show', [
            'book' => $book,
            'reviews' => $book->reviews()->paginate(5),
            'userHasBook' => !isset($user) ?: $user->hasBook($book->id)
        ]);
    }

    public function list(
        FiltersFormatter $filters,
        ListingGenreService $genreList,
        ListingPublisherService $publisherList
    ): View {
        $filters = $filters->format(
            ['q', 'publisher', 'genre', 'sort'],
            [
                'sort' => BookListing::SORT_DEFAULT,
                'publisher' => BookListing::TYPE_ALL,
                'genre' => BookListing::TYPE_ALL
            ]
        );

        return view('book.list', [
            'genres' => $genreList->all(),
            'publishers' => $publisherList->all(),
            'books' => $this->bookList->filterBy($filters),
            'filters' =>  $filters
        ]);
    }
}
