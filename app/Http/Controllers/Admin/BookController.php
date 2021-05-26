<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Service\Book\BookService;
use App\Service\Book\ListingGenreService;
use App\Service\Book\ListingPublisherService;
use App\Service\Book\ListingService;
use App\Service\BookListing;
use App\Service\FiltersFormatter;
use Illuminate\Http\RedirectResponse;
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

    public function show(int $id): View
    {
        return view('dashboard.bookItem', ['book' => $this->book->findById($id)]);
    }

    public function list(
        FiltersFormatter $filtersFormatter,
        ListingPublisherService $publisherList,
        ListingGenreService $genreList
    ): View {
        $filters = $filtersFormatter->format(
            ['q', 'publisher', 'genre', 'sort'],
            [
                'sort' => BookListing::SORT_DEFAULT,
                'publisher' => BookListing::TYPE_ALL,
                'genre' => BookListing::TYPE_ALL
            ]
        );

        return view('dashboard.bookList', [
            'books' => $this->bookList->filterBy($filters),
            'stats' => $this->bookList->stats(),
            'publishers' => $publisherList->all(),
            'genres' => $genreList->all(),
            'filters' => $filters
        ]);
    }

    public function create(ListingPublisherService $publisherList): View
    {
        return view('dashboard.addBook', ['publishers' => $publisherList->all()]);
    }

    public function insert(NewBookRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->book->create($data);

        return redirect()->route('admin.get.books')
            ->with('success', 'Nowa książka została dodana.');
    }

    public function edit(ListingPublisherService $publisherList, int $id): View
    {
        return view('dashboard.editBook', [
            'book' => $this->book->findById($id),
            'publishers' => $publisherList->all()
        ]);
    }

    public function update(UpdateBookRequest $request, int $id): RedirectResponse
    {
        $data = $request->all();

        $this->book->update($id, $data);

        return redirect()
            ->route(
                'admin.show.book',
                ['id' => $id]
            )->with('success', 'Profil użytkownika został zaktualizowany.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->book->delete($id);

        return redirect()->route('home')
            ->with('success', 'Książka została pomyślnie usunięta.');
    }
}
