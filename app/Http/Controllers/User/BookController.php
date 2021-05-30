<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Service\Book\BookService;
use App\Service\Book\ListingGenreService;
use App\Service\Book\ListingPublisherService;
use App\Service\BookListing;
use App\Service\FiltersFormatter;
use App\Service\User\UserLibraryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookController extends Controller
{
    private UserLibraryService $userLibrary;
    private BookService $book;

    public function __construct(
        UserLibraryService $userLibrary,
        BookService $book
    ) {
        $this->userLibrary = $userLibrary;
        $this->book = $book;
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

        return view('me.list', [
            'genres' => $genreList->all(),
            'publishers' => $publisherList->all(),
            'books' => $this->bookList->filterBy($filters),
            'filters' =>  $filters
        ]);
    }

    public function add(string $slug): RedirectResponse
    {
        $this->userLibrary->addBook($this->book->findBySlug($slug));

        return back()
            ->with('success', 'Książka zostałą dodana do twojej biblioteki.');
    }

    public function remove(string $slug): RedirectResponse
    {
        $this->userLibrary->removeBook($this->book->findBySlug($slug));

        return back()
            ->with('success', 'Książka zostałą usunięta z twojej bilbioteki.');
    }
}
