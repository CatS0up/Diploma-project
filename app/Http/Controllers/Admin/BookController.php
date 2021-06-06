<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Repositories\BookRepository;
use App\Service\Book\ListingPublisherService;
use App\Services\Book\BookCatalog;
use App\Services\Book\BookStats;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function show(int $id): View
    {
        return view('dashboard.bookItem', ['book' => $this->book->findById($id)]);
    }

    public function list(
        Request $request,
        BookCatalog $catalog,
        BookStats $stats
    ): View {
        $expectedFilters = ['q', 'genre', 'publisher', 'sort'];

        $filters = $request->only($expectedFilters);

        return view('dashboard.bookList', [
            'books' => $catalog->filteredBooks($filters, $expectedFilters),
            'genres' => $catalog->genres(),
            'publishers' => $catalog->publishers(),
            'filters' => $catalog->filters()
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

        return redirect()->route('admin.get.books')
            ->with('success', 'Książka została pomyślnie usunięta.');
    }
}
